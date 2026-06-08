<?php

namespace App\Repositories\Contracts;

interface BorrowingRepositoryInterface extends BaseRepositoryInterface
{
    public function findByUser(int $userId);
    public function findBorrowedBooks();
    public function findReturnedBooks();
    public function findOverdueBooks();
    public function updateOverdue();
}