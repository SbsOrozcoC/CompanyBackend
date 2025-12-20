<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
                Rule::unique('employees', 'identification')->ignore($this->employee),
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
}
