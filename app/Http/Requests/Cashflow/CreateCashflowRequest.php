<?php

namespace App\Http\Requests\Cashflow;

use Illuminate\Foundation\Http\FormRequest;

class CreateCashflowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|string|in:income,expense',
            'category_id' => 'required|integer',
            'amount' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ];
    }
}
