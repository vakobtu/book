<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'year',
        'publisher_id',
        'status'
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class)
        ->withDefault([
            'identifier' => 'WITHOUT ID ',
            'fname' => 'NOT FOUND',
            'lname' => 'NOT FOUND',
        ]);
    }

    public function authors()
    {
        return $this->belongstoMany(Author::class, 'book_authors')
        ->using(BookAuthor::class);
    }
}

