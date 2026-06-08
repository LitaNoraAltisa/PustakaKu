<?php

namespace App\Repositories;

use App\Models\ReturnBook;
use App\Repositories\Contracts\ReturnBookRepositoryInterface;

class ReturnBookRepository extends BaseRepository implements ReturnBookRepositoryInterface
{
    public function __construct(ReturnBook $returnBook)
    {
        parent::__construct($returnBook);
    }
    
    public function getAll()
    {
        return $this->model->with(['borrowing.user', 'borrowing.book'])->get();
    }

    public function findById($id)
    {
        return $this->model->with(['borrowing.user', 'borrowing.book', 'borrowing.book.author'])->findOrFail($id);
    }
    
    public function findByBorrowing(int $borrowingId)
    {
        return $this->model->with(['borrowing.user', 'borrowing.book'])->where('borrowing_id', $borrowingId)->first();
    }

    public function findWithFine()
    {
        return $this->model->with(['borrowing.user', 'borrowing.book'])->where('fine', '>', 0)->get();
    }

    public function findDamageReturns()
    {
        return $this->model->with(['borrowing.user', 'borrowing.book'])->where('condition', 'damaged')->get();
    }
}