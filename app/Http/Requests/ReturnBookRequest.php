<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'borrowing_id' => 'required|exists:borrowings,id',
            'condition' => 'required|in:good,damaged',
        ];
    }

    public function messages(): array
    {
        return [
            'borrowing_id.required' => 'ID peminjaman wajib diisi.',
            'borrowing_id.exists' => 'ID peminjaman tidak valid.',
            'condition.required' => 'Kondisi buku wajib diisi.',
            'condition.in' => 'Kondisi buku harus berupa "good" atau "damaged".',
        ];
    }
}
