<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateProdukRequest extends FormRequest
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
            'name' => 'nullable|string|between:3,30',
            'price' => 'nullable|numeric|min:0',
            'estimated_sales' => 'nullable|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('errorValidation',$validator->errors());
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama produk harus diisi',
            'name.string' => 'Nama produk harus berupa string',
            'name.between' => 'Nama produk harus antara 3 sampai 30 karakter',
            'name.unique' => 'Nama produk sudah ada',
            'price.required' => 'Harga produk harus diisi',
            'price.numeric' => 'Harga produk harus berupa angka',
            'price.min' => 'Harga produk minimal 0',
            'estimated_sales.required' => 'Estimasi penjualan produk harus diisi',
            'estimated_sales.numeric' => 'Estimasi penjualan produk harus berupa angka',
            'estimated_sales.min' => 'Estimasi penjualan produk minimal 0',
            'stock.required' => 'Stok produk harus diisi',
            'stock.numeric' => 'Stok produk harus berupa angka',
            'stock.min' => 'Stok produk minimal 0',
            'description.string' => 'Deskripsi produk harus berupa string',
        ];
    }
}
