<?php

namespace App\Services;

use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BorrowingService
{
    protected $borrowingRepository;
    protected $bookRepository;

    // inject repository untuk peminjaman
    public function __construct(BorrowingRepositoryInterface $borrowingRepository, BookRepositoryInterface $bookRepository)
    {
        $this->borrowingRepository = $borrowingRepository;
        $this->bookRepository = $bookRepository;
    }

    public function borrowBook(int $userId, int $bookId, int $days = 7)
    {
        // menggunakan transaksi untuk memastikan data konsisten
        return DB::transaction(function () use ($userId, $bookId, $days) {
            
            // ambil data buku berdasarkan ID
            $book = $this->bookRepository->findById($bookId);

            //cek ketersediaan stok buku
            if ($book->stock < 1) {
                throw new \Exception('Buku tidak tersedia untuk dipinjam');
            }

            // kurangi stok buku (dipinjam)
            $book->decrement('stock');

            // buat data peminjaman baru
            return $this->borrowingRepository->store([
                'user_id' => $userId,
                'book_id' => $bookId,
                'borrow_date' => now(),
                'return_deadline' => now()->addDays($days),
                'status' => 'borrowed',
            ]);
        });
    }
}