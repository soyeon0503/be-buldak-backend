<?php

namespace App\Http\Requests\SideMenu;

use App\Http\Requests\BaseRequest;

class SideMenuRequest extends BaseRequest
{
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|string|max:100',
                'image_path' => 'nullable|image|max:2048',
                'description' => 'required|string|max:255',
            ];
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            return [
                'title' => 'sometimes|required|string|max:100',
                'image_path' => 'sometimes|nullable|image|max:2048',
                'description' => 'sometimes|required|string|max:255',
            ];
        }

        return [];
    }
}
