<?php

namespace App\Http\Requests\Receipt;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'image_path' => 'nullable|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|array',
            'steps' => 'required|array',
            'servings' => 'required|integer|min:1',
            'cooking_time' => 'required|integer|min:1',
            'spicy' => 'required|integer|min:1|max:5',
            'recommend_side_menus' => 'required|array',
        ];
    }
}
