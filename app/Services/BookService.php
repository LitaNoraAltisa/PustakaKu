<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Contracts\BookRepositoryInterface;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function store(array $data, $file = null)
    {
        $data['slug'] = Str::slug($data['title']);

        // upload cover jika ada
        if ($file) {
            $data['cover'] = $file->store('covers', 'public');
        }

        return $this->bookRepository->store($data);
    }

    public function update(int $id, array $data, $file = null)
    {
        $data['slug'] = Str::slug($data['title']);

        // upload cover baru jika ada
        if ($file) {
            $book = $this->bookRepository->findById($id);
            // hapus cover lama jika ada
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $file->store('covers', 'public');
        } else {
            unset($data['cover']);
        }

        return $this->bookRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $book = $this->bookRepository->findById($id);
        // hapus cover saat buku dihapus
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        return $this->bookRepository->delete($id);
    }
}