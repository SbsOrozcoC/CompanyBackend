<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/'
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/'
            ],

            'identification' => [
                'required',
                'digits:10',
                'unique:employees,identification'
            ],

            'phone' => [
                'nullable',
                'digits_between:7,10'
            ],

            'address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'city_id' => ['required', 'exists:cities,id'],

            'positions'   => ['required', 'array', 'min:1'],
            'positions.*' => ['exists:positions,id'],

            'boss_id'      => ['nullable', 'exists:employees,id'],
            'is_president' => ['boolean'],
        ];
    }

    public function messages()
    {
        return [
            'positions.required'   => 'El empleado debe tener al menos un cargo.',
            'first_name.regex'     => 'El nombre no puede contener caracteres especiales.',
            'last_name.regex'      => 'El apellido no puede contener caracteres especiales.',
            'identification.digits' => 'La identificación debe tener exactamente 10 dígitos.',
            'phone.digits_between' => 'El teléfono debe tener máximo 10 dígitos.',
            'address.regex'        => 'La dirección contiene caracteres no permitidos.',
        ];
    }
}
