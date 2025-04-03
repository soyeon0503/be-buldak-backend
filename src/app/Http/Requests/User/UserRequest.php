<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'email' => 'required|email|unique:users,email',
                'name' => 'required|string|max:255',
                'password' => 'required|min:6',
                'birth' => 'nullable|date',
                'tier_id' => 'required|exists:tiers,id',
            ];
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            return [
                'email' => 'sometimes|email|unique:users,email,' . $this->route('id'),
                'name' => 'sometimes|string|max:255',
                'password' => 'sometimes|min:6',
                'birth' => 'nullable|date',
                'tier_id' => 'sometimes|exists:tiers,id',
            ];
        }

        return [];
    }
}
