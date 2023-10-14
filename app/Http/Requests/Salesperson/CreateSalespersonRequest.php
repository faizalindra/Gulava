<?php

namespace App\Http\Requests\Salesperson;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateSalespersonRequest extends FormRequest
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
            'nik' => 'required|numeric|digits:16|unique:salespersons,nik',
            'name' => 'required|string|min:3|max:40',
            'gender' => 'required|in:M,F',
            'email' => 'required|email|unique:salespersons,email',
            'phone' => 'required|min:8|max:15|unique:salespersons,phone',
            'address' => 'required|string|min:5|max:100',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('errorValidation',$validator->errors());
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK harus diisi',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.digits' => 'NIK harus 16 digit',
            'nik.unique' => 'NIK sudah ada',
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa huruf',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 40 karakter',
            'gender.required' => 'Jenis Kelamin harus diisi',
            'gender.in' => 'Jenis Kelamin harus Laki-laki atau Perempuan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email',
            'email.unique' => 'Email sudah ada',
            'phone.required' => 'Nomor Telepon harus diisi',
            'phone.min' => 'Nomor Telepon minimal 8 digit',
            'phone.max' => 'Nomor Telepon maksimal 15 digit',
            'phone.unique' => 'Nomor Telepon sudah ada',
            'address.required' => 'Alamat harus diisi',
            'address.string' => 'Alamat harus berupa huruf',
            'address.min' => 'Alamat minimal 5 karakter',
            'address.max' => 'Alamat maksimal 100 karakter',
        ];
    }
}
