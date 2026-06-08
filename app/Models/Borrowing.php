<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;
use App\Models\ReturnBook;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_deadline',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_deadline' => 'date',
    ];
    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi dengan Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    // Relasi dengan ReturnBook
    public function returnBook()
    {
        return $this->hasOne(ReturnBook::class);
    }
    // Fungsi untuk mengecek apakah peminjaman sudah melewati batas waktu pengembalian
    public function isOverdue(): bool
    {
        return $this->status === 'borrowed' && $this->return_deadline < now();
    }
    // Cek apakah buku sudah dikembalikan`  1
    public function isReturned(): bool
    {
        return $this->status === 'returned';
    }
}
