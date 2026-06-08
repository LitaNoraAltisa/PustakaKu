<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
        $bookId = $this->route('book') ?? $this->route('id');

        return [
            'title'       => 'required|string|max:255',
            'author_id'   => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            // ignore id buku yang sedang diedit agar ISBN tidak dianggap duplikat saat update
            'isbn' => ['required', 'string', Rule::unique('books', 'isbn')->ignore($bookId)],
            'publisher'   => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'title.string' => 'Judul buku harus berupa teks.',
            'title.max' => 'Judul buku maksimal 255 karakter.',
            'author_id.required' => 'ID penulis wajib diisi.',
            'author_id.exists' => 'ID penulis tidak valid.',
            'category_id.required' => 'ID kategori wajib diisi.',
            'category_id.exists' => 'ID kategori tidak valid.',
            'isbn.required' => 'ISBN wajib diisi.',
            'isbn.string' => 'ISBN harus berupa teks.',
            'isbn.unique' => 'ISBN sudah digunakan oleh buku lain.',
            'publisher.required' => 'Penerbit wajib diisi.',
            'publisher.string' => 'Penerbit harus berupa teks.',
            'publisher.max' => 'Penerbit maksimal 255 karakter.',
            'publication_year.required' => 'Tahun publikasi wajib diisi.',
            'publication_year.integer' => 'Tahun publikasi harus berupa angka.',
            'publication_year.min' => 'Tahun publikasi tidak valid.',
            'publication_year.max' => 'Tahun publikasi tidak valid.',
            'stock.integer' => 'Stok buku harus berupa angka.',
            'stock.min' => 'Stok buku minimal adalah 0.',
            'cover.image' => 'Cover harus berupa gambar.',
            'cover.mimes' => 'Cover harus berformat jpg, jpeg, atau png.',
            'cover.max'   => 'Ukuran cover maksimal 2MB.',
        ];
    }
}
