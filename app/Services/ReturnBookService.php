<?php

namespace App\Services;

use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use App\Repositories\Contracts\ReturnBookRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReturnBookService
{
    protected $borrowingRepository;
    protected $returnBookRepository;
    protected $bookRepository;

    // inject repository untuk pengembalian
    public function __construct(BorrowingRepositoryInterface $borrowingRepository, ReturnBookRepositoryInterface $returnBookRepository, BookRepositoryInterface $bookRepository)
    {
        $this->borrowingRepository = $borrowingRepository;
        $this->returnBookRepository = $returnBookRepository;
        $this->bookRepository = $bookRepository;
    }
    // fungsi untuk mengembalikan buku
    public function returnBook(int $borrowingId, string $condition = 'good')
    {
        return DB::transaction(function () use ($borrowingId, $condition) {
            // ambil data peminjaman berdasarkan ID
            $borrowing = $this->borrowingRepository->findById($borrowingId);


            // cek status peminjaman
            $existingReturn = $this->returnBookRepository->findByBorrowing($borrowingId);

            // jika sudah ada data pengembalian untuk peminjaman ini, berarti buku sudah dikembalikan
            if ($existingReturn) {
                throw new \Exception('Buku sudah dikembalikan sebelumnya');
            }

            // ambil data buku yang dipinjam
            $book = $this->bookRepository->findById($borrowing->book_id);

            // hitung denda keterlambatan dan kerusakan
            $fine = 0;

            // jika tanggal sekarang sudah melewati batas pengembalian, hitung denda keterlambatan
            if(now()->gt($borrowing->return_deadline)) {
                $fine += now()->startOfDay()->diffInDays($borrowing->return_deadline) * 1000;
            }

            // jika kondisi buku rusak, tambahkan denda kerusakan
            if ($condition === 'damaged') {
                $fine += 5000;
            }

            // simpan data pengembalian
            $return = $this->returnBookRepository->store([
                'borrowing_id' => $borrowingId,
                'return_date' => now(),
                'condition' => $condition,
                'fine' => $fine,
            ]);

            // update status peminjaman menjadi 'returned' dan kembalikan stok buku
            $borrowing->update(['status' => 'returned']);
            $book->increment('stock');

            return $return; // kembalikan data pengembalian yang baru dibuat
        });
    }
}