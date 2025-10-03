<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }
    

    public function rules(): array
    {
        $common = [
            'birth'     => ['nullable', 'date'],
            'tier_id' => ['sometimes', 'nullable', 'exists:tiers,id'],
            'provider'  => ['nullable', 'in:local,kakao,google'],
        ];

        // ▶ POST (회원가입)
        if ($this->isMethod('post')) {
            return array_merge($common, [
                'email'    => ['required', 'email', 'max:100', 'unique:users,email'],
                'name'     => ['required', 'string', 'max:50'],
                'password' => [
                    'required', 'string', 'min:8', 'max:30', 'confirmed',
                    'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@*&^]).+$/'
                ]
            ]);
        }

        // ▶ PUT / PATCH (회원정보 수정)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $userId = $this->route('id'); // /users/{id} 에서 ID 추출

            return array_merge([
                'email'    => ['sometimes', 'email', 'max:100', "unique:users,email,$userId"],
                'name'     => ['sometimes', 'string', 'max:50'],
                'password' => [
                    'sometimes', 'string', 'min:8', 'max:30', 'confirmed',
                    'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@*&^]).+$/'
                ],
                'tier_id' => ['sometimes', 'integer', 'between:1,5'],
                'birth'    => ['nullable', 'date'],
                'provider' => ['nullable', 'in:local,kakao,google'],
            ]);
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'email.unique'        => '이미 등록된 이메일입니다.',
            'password.confirmed'  => '비밀번호가 확인 값과 일치하지 않습니다.',
            'password.regex'      => '비밀번호는 대소문자, 숫자, 특수문자를 포함한 8~30자여야 합니다.',
            'tier_id.exists'      => '선택한 티어가 존재하지 않습니다.',
            'provider.in'         => 'provider 값은 local, kakao, google 중 하나여야 합니다.',
        ];
    }
}
