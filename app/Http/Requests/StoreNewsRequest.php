<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Все наши ошибки валидации будут на Eu, что бы русифицировать их, нужно
 * создать папку /ru в /resources/ru
 * а там создать файлы типа
 * - auth.php
 * - pagination.php
 *
 * так же не обходимо задать Ру язык в
 * ../config/app.php -> 'locale' => 'ru',
 *
 * ---
 *
 * Создаем наш request так:
 * php artisan make:request StoreNewsRequest
 *
 * на одну форму - создаем один request !!!
 */
class StoreNewsRequest extends FormRequest
{
    /**
     * Нужен для того что бы определять пускать ли текущего пользователя
     * или нет, на страницу что бы он мог работать с текущей формой
     *
     * Используется редко, чаще применяется в сложных CRM где много ролей и прав
     *
     * Например ЕСЛИ пользователь АДМИН, ТО... true, если НЕТ то false
     *
     * true - значит допускает
     * false - не допускает
     *
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

            /** sometimes - поле может быть, а может и не быть, типа ?? */
            'status' => ['sometimes'],
            'description' => ['sometimes'],
        ];
    }

    public function messages(): array
    {
        /**
         * переопределяем дефолтные сообщения об ошибках итп
         * return parent::messages();
         *
         * required - событие возникающее при валидации required = false
         */
        return [
            'required' => 'Это поле нужно заполнить (Поле: attribute)',
        ];
    }

    public function attributes(): array
    {
        /**
         * задаем названия полей за место дефолтных
         * return parent::attributes();
         */

        return [
            'title' => 'Заголовок',
            'author' => 'Создатель',
        ];
    }
}
