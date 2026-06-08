<?php

namespace App\Repositories\Contracts;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug);
    public function findByCategory(int $categoryId);
    public function findByAuthor(int $authorId);
    public function findByIsbn(string $isbn);
}