<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{

    protected $fillable = ['title', 'author', 'publisher', 'synopsis', 'language', 'price', 'weight', 'page', 'chapter', 'isbn', 'stockcount', 'publishyear', 'popularity', 'date_added', 'isnew', 'bookimage1', 'bookimage2', 'bookimage3'];

    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'bookcategory', 'book_id', 'category_id');
    }
    public function discount(): HasMany
    {
        return $this->hasMany(Discount::class);
    }
}
