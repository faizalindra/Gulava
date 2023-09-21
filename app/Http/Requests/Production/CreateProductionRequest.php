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
            'product_id' => 'required|numeric', // Example validation for 'product_id'
            'description' => 'nullable|string', // Example validation for 'description'

            // You can add validation rules for the dynamic materials as well.
            'materials' => 'required|array',
            'materials.id.*' => 'required|numeric',
            'materials.quantity_used.*' => 'required|numeric|min:0',
            'materials.estimated_cost.*' => 'required|numeric|min:0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('errorValidation',$validator->errors());
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Product ID harus diisi',
            'product_id.numeric' => 'Product ID harus berupa angka',
            'description.string' => 'Deskripsi produksi harus berupa string',

            // You can add validation messages for the dynamic materials as well.
            'materials.required' => 'Material harus diisi',
            'materials.id.*.required' => 'ID material harus diisi',
            'materials.id.*.numeric' => 'ID material harus berupa angka',
            'materials.quantity_used.*.required' => 'Jumlah material harus diisi',
            'materials.quantity_used.*.numeric' => 'Jumlah material harus berupa angka',
            'materials.quantity_used.*.min' => 'Jumlah material minimal 0',
            'materials.estimated_cost.*.required' => 'Estimasi biaya material harus diisi',
            'materials.estimated_cost.*.numeric' => 'Estimasi biaya material harus berupa angka',
            'materials.estimated_cost.*.min' => 'Estimasi biaya material minimal 0',
        ];
    }
}
