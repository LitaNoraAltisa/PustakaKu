<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequest;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use App\Services\BorrowingService;

class BorrowingController extends Controller
{
    protected $borrowingRepository;
    protected $bookRepository;
    protected $borrowingService;

    public function __construct(
        BorrowingRepositoryInterface $borrowingRepository,
        BookRepositoryInterface $bookRepository,
        BorrowingService $borrowingService
    ) {
        $this->borrowingRepository = $borrowingRepository;
        $this->bookRepository = $bookRepository;
        $this->borrowingService = $borrowingService;
    }

    public function index()
    {
        $borrowings = $this->borrowingRepository->getAll();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = $this->bookRepository->getAll();
        $users = \App\Models\User::where('role', 'member')->get();
        return view('borrowings.create', compact('books', 'users'));
    }

    public function store(BorrowingRequest $request)
    {
        $data = $request->validated();
        $this->borrowingService->borrowBook(
            $data['user_id'],
            $data['book_id'],
            $data['days'] ?? 7
        );

        return redirect()->route('borrowings.index')
            ->with('success', 'Buku berhasil dipinjam.');
    }

    public function show($id)
    {
        $borrowing = $this->borrowingRepository->findById($id);
        return view('borrowings.show', compact('borrowing'));
    }

    public  function destroy($id)
    {
        $this->borrowingRepository->delete($id);

        return redirect()->route('borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}
