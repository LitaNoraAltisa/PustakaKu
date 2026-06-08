<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Author;
use App\Models\Borrowing;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'isbn',
        'publisher',
        'publication_year',
        'stock',
        'cover',
    ];

    // relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // relasi dengan Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    // relasi dengan Borrowing
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
    // fungsi untuk mengecek ketersediaan buku
    public function isAvailable()
    {
        return $this->stock > 0;
    }
}
