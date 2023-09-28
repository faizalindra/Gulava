<?php

namespace App\Http\Requests\RawMaterial;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateRawMaterialRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'price' => 'required|numeric|digits_between:1,10|min:0',
            'stock_min' => 'required|integer|digits_between:1,5|min:0',
            'stock' => 'required|integer|digits_between:1,5|min:0',
            'unit' => 'required|string|max:255|min:1',
            'suppliers' => 'required|array',
            'suppliers.*' => 'required|integer|exists:suppliers,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('error', $validator->errors());
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama bahan baku harus diisi',
            'name.string' => 'Nama bahan baku harus berupa huruf',
            'name.max' => 'Nama bahan baku maksimal 255 karakter',
            'name.min' => 'Nama bahan baku minimal 3 karakter',
            'price.required' => 'Harga bahan baku harus diisi',
            'price.numeric' => 'Harga bahan baku harus berupa angka',
            'price.digits_between' => 'Harga bahan baku maksimal 10 digit',
            'price.min' => 'Harga bahan baku minimal 0',
            'stock_min.required' => 'Stok minimal bahan baku harus diisi',
            'stock_min.integer' => 'Stok minimal bahan baku harus berupa angka',
            'stock_min.digits_between' => 'Stok minimal bahan baku maksimal 5 digit',
            'stock_min.min' => 'Stok minimal bahan baku minimal 0',
            'stock.required' => 'Stok bahan baku harus diisi',
            'stock.integer' => 'Stok bahan baku harus berupa angka',
            'stock.digits_between' => 'Stok bahan baku maksimal 5 digit',
            'stock.min' => 'Stok bahan baku minimal 0',
            'unit.required' => 'Satuan bahan baku harus diisi',
            'unit.string' => 'Satuan bahan baku harus berupa huruf',
            'unit.max' => 'Satuan bahan baku maksimal 255 karakter',
            'unit.min' => 'Satuan bahan baku minimal 1 karakter',
            'suppliers.required' => 'Pemasok bahan baku harus diisi',
            'suppliers.array' => 'Pemasok bahan baku harus berupa array',
            'suppliers.*.required' => 'Pemasok bahan baku harus diisi',
            'suppliers.*.integer' => 'Pemasok bahan baku harus berupa angka',
            'suppliers.*.exists' => 'Pemasok bahan baku tidak ditemukan',
        ];
    }
}
