<?php

namespace App\Http\Requests\Logistic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateReturingGoodRequest extends FormRequest
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
            'total_price_' => 'required|numeric|min:0',
            'sales_fee_' => 'required|numeric|min:0',
            'description_' => 'nullable|string|max:256',
            // 'produk_id_' => 'required|numeric',
            // 'price_' => 'required|integer',
            'products_' => 'required|array',
            'products_.produk_id' => 'required|array',
            'products_.name' => 'required|array',
            'products_.price' => 'required|array',
            'products_.quantity' => 'required|array',
            'products_.total_price' => 'required|array',
            'products_.produk_id.*' => 'required|integer',
            'products_.name.*' => 'required|string',
            'products_.price.*' => 'required|numeric|min:0',
            'products_.quantity.*' => 'required|numeric|min:0',
            'products_.total_price.*' => 'required|numeric|min:0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // dd($validator->errors());
        return back()->with('error', $validator->errors());
    }

    public function messages()
    {
        return [
            'total_price_.required' => 'Total harga harus diisi',
            'total_price_.numeric' => 'Total harga harus berupa angka',
            'total_price_.min' => 'Total harga minimal 0',
            'sales_fee_.required' => 'Biaya sales harus diisi',
            'sales_fee_.numeric' => 'Biaya sales harus berupa angka',
            'sales_fee_.min' => 'Biaya sales minimal 0',
            'description_.required' => 'Deskripsi harus diisi',
            'description_.string' => 'Deskripsi harus berupa string',
            'produk_id_.required' => 'Produk harus diisi',
            'produk_id_.numeric' => 'Produk harus berupa angka',
            'price_.required' => 'Harga harus diisi',
            'products_.required' => 'Produk harus diisi',
            'products_.array' => 'Produk harus berupa array',
            'products_.name.required' => 'Nama produk harus diisi',
            'products_.name.array' => 'Nama produk harus berupa array',
            'products_.price.required' => 'Harga produk harus diisi',
            'products_.price.array' => 'Harga produk harus berupa array',
            'products_.quantity.required' => 'Kuantitas produk harus diisi',
            'products_.quantity.array' => 'Kuantitas produk harus berupa array',
            'products_.total_price.required' => 'Harga total produk harus diisi',
            'products_.total_price.array' => 'Harga total produk harus berupa array',
            'products_.name.*.required' => 'Nama produk harus diisi',
            'products_.name.*.string' => 'Nama produk harus berupa string',
            'products_.price.*.required' => 'Harga produk harus diisi',
            'products_.price.*.numeric' => 'Harga produk harus berupa angka',
            'products_.price.*.min' => 'Harga produk minimal 0',
            'products_.quantity.*.required' => 'Kuantitas produk harus diisi',
            'products_.quantity.*.numeric' => 'Kuantitas produk harus berupa angka',
            'products_.quantity.*.min' => 'Kuantitas produk minimal 0',
            'products_.total_price.*.required' => 'Harga total produk harus diisi',
            'products_.total_price.*.numeric' => 'Harga total produk harus berupa angka',
            'products_.total_price.*.min' => 'Harga total produk minimal 0',
        ];
    }
}
