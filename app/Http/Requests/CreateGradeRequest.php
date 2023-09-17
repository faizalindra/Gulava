<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateGradeRequest extends FormRequest
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
            'name' => 'required|alpha|unique:produks_grades,name|between:3,20',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('errorValidation',$validator->errors());
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama grade harus diisi',
            'nama.alpha' => 'Nama grade harus berupa huruf',
            'nama.unique' => 'Nama grade sudah ada',
            'nama.between' => 'Nama grade harus antara 3 sampai 20 karakter',
        ];
    }
}
