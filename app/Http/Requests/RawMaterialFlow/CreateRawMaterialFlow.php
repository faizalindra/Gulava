<?php

namespace App\Http\Requests\RawMaterialFlow;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateRawMaterialFlow extends FormRequest
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
            'raw_material_id_' => 'required|exists:raw_materials,id',
            'supplier_id_' => 'required|exists:suppliers,id',
            'is_in_' => 'nullable|boolean',
            'quantity_' => 'required|numeric',
            'price_' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('errorValidation',$validator->errors());
    }

    public function messages()
    {
        return [
            'raw_material_id_.required' => 'Bahan baku harus diisi',
            'raw_material_id_.exists' => 'Bahan baku tidak ditemukan',
            'supplier_id_.required' => 'Supplier harus diisi',
            'supplier_id_.exists' => 'Supplier tidak ditemukan',
            'is_in_.boolean' => 'Status harus berupa boolean',
            'quantity_.required' => 'Jumlah harus diisi',
            'quantity_.numeric' => 'Jumlah harus berupa angka',
            'price_.required' => 'Harga harus diisi',
            'price_.numeric' => 'Harga harus berupa angka',
        ];
    }
}
