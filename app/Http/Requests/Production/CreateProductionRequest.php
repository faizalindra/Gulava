<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class CreateProductionRequest extends FormRequest
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
            'produks_id' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'material_count' => 'required|integer|min:1',
            'materials' => 'required|array',
            'materials.id.*' => 'required|integer',
            'materials.quantity_used.*' => 'required|numeric|min:0',
            'materials.estimated_cost.*' => 'required|numeric|min:0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('errorValidation',$validator->errors());
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product ID harus diisi',
            'product_id.integer' => 'Product ID harus berupa angka',
            'product_id.min' => 'Product ID minimal 1',
            'description.string' => 'Deskripsi produksi harus berupa string',
            'material_count.required' => 'Bahan Baku harus diisi',
            'material_count.integer' => 'Jumlah Bahan Baku harus berupa angka',
            'material_count.min' => 'Minimal 1 Bahan Baku',
            'materials.required' => 'Bahan Baku harus diisi',
            'materials.array' => 'Bahan Baku harus berupa array',
            'materials.id.*.required' => 'Bahan Baku harus diisi',
            'materials.id.*.integer' => 'Bahan Baku harus berupa angka',
            'materials.quantity_used.*.required' => 'Jumlah Bahan Baku harus diisi',
            'materials.quantity_used.*.numeric' => 'Jumlah Bahan Baku harus berupa angka',
            'materials.quantity_used.*.min' => 'Jumlah Bahan Baku minimal 0',
            'materials.estimated_cost.*.required' => 'Estimasi biaya Bahan Baku harus diisi',
            'materials.estimated_cost.*.numeric' => 'Estimasi biaya Bahan Baku harus berupa angka',
            'materials.estimated_cost.*.min' => 'Estimasi biaya Bahan Baku minimal 0',
        ];
    }
}
