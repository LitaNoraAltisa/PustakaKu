<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrowing;

class ReturnBook extends Model
{
    use HasFactory;

    protected $table = 'return_books';

    protected $fillable = [
        'borrowing_id',
        'return_date',
        'condition',
        'fine',
    ];
    
    protected $casts = [
        'return_date' => 'date',
    ];
    // Relasi dengan Borrowing
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
    // cek apakah buku dalam kondisi baik.
    public function isDamaged(): bool
    {
        return $this->condition === 'damaged';
    }
    // cek apakah ada denda
    public function hasFine(): bool
    {
        return $this->fine > 0;
    }
}
