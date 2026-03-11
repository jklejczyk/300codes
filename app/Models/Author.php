<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = ['first_name', 'last_name', 'last_book_title'];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
