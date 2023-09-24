<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class FinishProductionRequest extends FormRequest
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
            'estimated_cost' => 'required|numeric|min:0',
            'quantity_produced' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
            'completed_at' => 'required|date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('errorValidation',$validator->errors());
    }

    public function messages()
    {
        return [
            'estimated_cost.required' => 'Estimasi Harga produksi harus diisi',
            'estimated_cost.numeric' => 'Estimasi Harga produksi harus berupa angka',
            'estimated_cost.min' => 'Estimasi Harga produksi minimal 0',
            'quantity_produced.required' => 'Hasil produksi harus diisi',
            'quantity_produced.numeric' => 'Hasil produksi harus berupa angka',
            'quantity_produced.min' => 'Hasil produksi minimal 0',
            'completed_at.required' => 'Tanggal selesai produksi harus diisi', 
            'completed_at.date' => 'Tanggal selesai produksi harus berupa tanggal',
        ];
    }
}
