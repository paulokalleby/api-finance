<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_id' => ['required', 'exists:accounts,id', 'uuid'],
            'name'       => ['required', 'string', 'min:3', 'max:50'],
            'summary'    => ['required', 'string' ,'min:3', 'max:100'],
            'type'       => ['required', Rule::in(array_keys(config('enums.type')))],
            'cost'       => ['required'],
        ];
    }
}
