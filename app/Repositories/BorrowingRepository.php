<?php

namespace App\Repositories;

use App\Models\Borrowing;
use App\Repositories\Contracts\BorrowingRepositoryInterface;

class BorrowingRepository extends BaseRepository implements BorrowingRepositoryInterface
{
    public function __construct(Borrowing $borrowing)
    {
        parent::__construct($borrowing);
    }

    public function getAll()
    {
        return $this->model->with(['user', 'book'])->get();
    }

    public function findByUser($id)
    {
        return $this->model->with(['user', 'book'])->where('user_id', $id)->get();
    }

    public function findBorrowedBooks()
    {
        return $this->model
            ->with(['user', 'book'])->whereIn('status', ['borrowed', 'overdue'])->get();
    }

    public function findReturnedBooks()
    {
        return $this->model->with(['user', 'book'])->where('status', 'returned')->get();
    }

    public function findOverdueBooks()
    {
        return $this->model->with(['user', 'book'])->where('status', 'overdue')->get();
    }

    public function updateOverdue()
    {
        return $this->model->where('status', 'borrowed')
        ->where('return_deadline', '<', now()->startOfDay())
        ->update(['status' => 'overdue']);
    }
}