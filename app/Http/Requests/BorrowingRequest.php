<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowingRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'days' => 'nullable|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'ID pengguna wajib diisi.',
            'user_id.exists' => 'ID pengguna tidak valid.',
            'book_id.required' => 'ID buku wajib diisi.',
            'book_id.exists' => 'ID buku tidak valid.',
            'days.integer' => 'Jumlah hari harus berupa angka.',
            'days.min' => 'Jumlah hari minimal adalah 1.',
        ];
    }
}
