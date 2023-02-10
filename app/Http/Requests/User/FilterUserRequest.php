<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FilterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => 'numeric',
            'name' => 'string|max:60',
            'phone' => 'string|max:13',
            'email' => 'string|max:254',
            'position' => 'string|max:254',
            'page' => 'integer|min:1',
            'offset' => 'integer|min:0',
            'count' => 'integer|min:1|max:100'
        ];
    }
}
