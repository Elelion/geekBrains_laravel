<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'category_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'min:5', 'max:191'],
            'author' => ['string', 'min:2', 'max:80'],
            'status' => ['sometimes'],
            'description' => ['sometimes'],
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
            'title' => 'Заголовок',
            'author' => '[Хозяин]',
        ];
    }
}
