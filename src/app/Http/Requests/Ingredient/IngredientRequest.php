<?php

namespace App\Http\Requests\Ingredient;

use App\Http\Requests\BaseRequest;

class IngredientRequest extends BaseRequest
{
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|string|max:100',
                'description' => 'nullable|string|max:255',

            ];
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            return [
                'title' => 'sometimes|required|string|max:100',
                'description' => 'sometimes|nullable|string|max:255',
            ];
        }

        return [];
    }
}
