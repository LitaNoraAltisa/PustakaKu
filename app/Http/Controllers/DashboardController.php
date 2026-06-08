<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\AuthorRepositoryInterface;
use App\Repositories\Contracts\ReturnBookRepositoryInterface;

class DashboardController extends Controller
{
    protected $bookRepository;
    protected $borrowingRepository;
    protected $categoryRepository;
    protected $authorRepository;
    protected $returnBookRepository;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        BorrowingRepositoryInterface $borrowingRepository,
        CategoryRepositoryInterface $categoryRepository,
        AuthorRepositoryInterface $authorRepository,
        ReturnBookRepositoryInterface $returnBookRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->borrowingRepository = $borrowingRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
        $this->returnBookRepository = $returnBookRepository;
    }

    // dashboard admin
    public function admin()
    {
        $this->borrowingRepository->updateOverdue();
        
        $stats = [
            'total_books'      => $this->bookRepository->count(),
            'total_categories' => $this->categoryRepository->count(),
            'total_authors'    => $this->authorRepository->count(),
            'total_borrowings' => $this->borrowingRepository->count(),
            'borrowed'         => $this->borrowingRepository->findBorrowedBooks()->count(),
            'returned'         => $this->borrowingRepository->findReturnedBooks()->count(),
            'overdue'          => $this->borrowingRepository->findOverdueBooks()->count(),
            'total_returns'    => $this->returnBookRepository->count(),
        ];

        $latestBorrowings = $this->borrowingRepository->getAll()->take(5);

        return view('admin.dashboard', compact('stats', 'latestBorrowings'));
    }

    // dashboard member
    public function member()
    {
        $books = $this->bookRepository->getAll()->load(['category', 'author']);
        $booksByCategory = $books->groupBy('category.name');

        return view('member.dashboard', compact('books', 'booksByCategory'));
    }
}