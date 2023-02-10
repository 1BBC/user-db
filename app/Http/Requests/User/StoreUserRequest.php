<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60|min:2',
            'email' => 'required|email:rfc|unique:users',
            'phone' => 'required|regex:/^[\+]{0,1}380\d{9}$/|unique:users',
            'position_id' => 'required|exists:positions,id',
            'photo' => 'required|image|mimes:jpeg,jpg|dimensions:min_width=70,min_height=70|max:5120',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages(): array
    {
        return [
            'phone.regex' => __('The phone must start with +380 and have 9 digits.'),
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation(): void
    {
        $this->replace(['phone' => str($this->phone)->start('+')]);
    }
}
