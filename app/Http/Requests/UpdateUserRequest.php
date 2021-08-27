<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:191'],
            'email' => ['required', 'string', 'min:6', 'max:80'],
            'is_admin' => ['integer'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Это поле нужно заполнить (Поле: attribute)',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '[имя]',
            'email' => '[login/email]',
            'is_admin' => ['права'],
        ];
    }
}
