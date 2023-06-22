<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:3', 'max:50'],
            'summary' => ['required', 'string' ,'min:3', 'max:100'],
            'value'   => ['required'],
        ];
    }
}
