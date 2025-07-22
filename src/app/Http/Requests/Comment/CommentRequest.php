<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseRequest;

class CommentRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'recipe_id' => ['required', 'exists:recipes,id'],
            'score'     => ['required', 'integer', 'between:1,5'],
            'context'   => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'score.between' => '별점은 1점 이상 5점 이하로 입력해주세요.',
            'context.max'   => '댓글은 최대 500자까지 작성 가능합니다.',
        ];
    }
}