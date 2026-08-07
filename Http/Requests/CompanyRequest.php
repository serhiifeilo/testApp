<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:256',
            ],

            'edrpou' => [
                'required',
                'string',
                'size:10',
            ],

            'address' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'edrpou.required' => 'EDRPOU is required.',
            'edrpou.size' => 'EDRPOU must contain exactly 10 characters.',
            'address.required' => 'Address is required.',
        ];
    }
}