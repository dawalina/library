<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
        $nameRules = [
            'first_name' => 'string',
            'last_name'  => 'string'
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return [
                    'first_name' => 'required|string',
                    'last_name'  => 'required|string'
                ];
            case 'GET':
            case 'PUT':
                return $nameRules;
            case 'DELETE':
                return [];
        }
    }
}
