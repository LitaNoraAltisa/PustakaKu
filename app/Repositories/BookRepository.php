<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    // constructor untuk menginisialisasi model Book
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }

    // method untuk mencari buku berdasarkan slug
    public function findBySlug(string $slug)
    {
        return $this->model->with(['category', 'author'])->where('slug', $slug)->firstOrFail();
    }

    // method untuk mencari buku berdasarkan category
    public function findByCategory(int $categoryId)
    {
        return $this->model->with(['category', 'author'])->where('category_id', $categoryId)->get();
    }

    // method untuk mencari buku berdasarkan author
    public function findByAuthor(int $authorId)
    {
        return $this->model->with(['category', 'author'])->where('author_id', $authorId)->get();
    }
    
    // method untuk mencari buku berdasarkan Isbn
    public function findByIsbn(string $isbn)
    {
        return $this->model->with(['category', 'author'])->where('isbn', $isbn)->firstOrFail();
    }
}
