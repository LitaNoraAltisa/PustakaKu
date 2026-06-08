<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnBookRequest;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use App\Repositories\Contracts\ReturnBookRepositoryInterface;
use App\Services\ReturnBookService;
use App\Http\Controllers\Controller;

class ReturnBookController extends Controller
{
    protected $returnBookRepository;
    protected $borrowingRepository;
    protected $returnBookService;

    public function __construct(
        ReturnBookRepositoryInterface $returnBookRepository,
        BorrowingRepositoryInterface $borrowingRepository,
        ReturnBookService $returnBookService
    ) {
        $this->returnBookRepository = $returnBookRepository;
        $this->borrowingRepository = $borrowingRepository;
        $this->returnBookService = $returnBookService;
    }

    // menampilkan semua pengembalian
    public function index()
    {
        $returns = $this->returnBookRepository->getAll();
        return view('return_books.index', compact('returns'));
    }

    // menampilkan form pengembalian buku
    public function create()
    {
        $borrowings = $this->borrowingRepository->findBorrowedBooks();
        return view('return_books.create', compact('borrowings'));
    }

    // menyimpan pengembalian buku
    public function store(ReturnBookRequest $request)
    {
        $data = $request->validated();

        $this->returnBookService->returnBook(
            $data['borrowing_id'],
            $data['condition']
        );

        return redirect()->route('return_books.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }

    // menampilkan detail pengembalian
    public function show($id)
    {
        $return = $this->returnBookRepository->findById($id);
        return view('return_books.show', compact('return'));
    }
}