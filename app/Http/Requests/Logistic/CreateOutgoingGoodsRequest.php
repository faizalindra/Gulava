<?php

namespace App\Http\Requests\Logistic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateOutgoingGoodsRequest extends FormRequest
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
            'salesperson_id' => 'required|integer|min:1|exists:salespersons,id',
            'description' => 'required|string',
            'product_count' => 'required|integer|min:1',
            'products' => 'required|array',
            'products.product_id.*' => 'required|integer|min:1|exists:produks,id|distinct',
            'products.quantity.*' => 'required|integer|min:1',
            'products.price.*' => 'required|integer|min:1',
            'products.total_price.*' => 'integer|min:1',
            'products.description.*' => 'string',  
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('error',$validator->errors());
    }

    public function messages()
    {
        return [
            'salesperson_id.required' => 'Salesperson harus diisi',
            'salesperson_id.integer' => 'Salesperson harus berupa angka',
            'salesperson_id.min' => 'Salesperson minimal 1',
            'salesperson_id.exists' => 'Salesperson tidak ditemukan',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa string',
            'product_count.required' => 'Produk harus diisi',
            'product_count.integer' => 'Produk harus berupa angka',
            'product_count.min' => 'Produk minimal 1',
            'products.required' => 'Produk harus diisi',
            'products.array' => 'Produk harus berupa array',
            'products.product_id.*.required' => 'Produk harus diisi',
            'products.product_id.*.integer' => 'Produk harus berupa angka',
            'products.product_id.*.min' => 'Produk minimal 1',
            'products.product_id.*.exists' => 'Produk tidak ditemukan',
            'products.product_id.*.distinct' => 'Produk tidak boleh sama',
            'products.quantity.*.required' => 'Kuantitas harus diisi',
            'products.quantity.*.integer' => 'Kuantitas harus berupa angka',
            'products.quantity.*.min' => 'Kuantitas minimal 1',
            'products.price.*.required' => 'Harga harus diisi',
            'products.price.*.integer' => 'Harga harus berupa angka',
            'products.price.*.min' => 'Harga minimal 1',
            'products.total_price.*.integer' => 'Total harga harus berupa angka',
            'products.total_price.*.min' => 'Total harga minimal 1',
            'products.description.*.string' => 'Deskripsi harus berupa string',
        ];
    }
}
