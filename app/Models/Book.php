<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{

    protected $fillable = ['title', 'author', 'publisher', 'synopsis', 'language', 'price', 'weight', 'page', 'chapter', 'isbn', 'stockcount', 'publishyear', 'popularity', 'date_added', 'isnew', 'bookimage1', 'bookimage2', 'bookimage3'];



    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'bookcategory', 'book_id', 'category_id');
    }

    public function latestDiscount()
    {
        return $this->discounts()->latest('created_at')->first();
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'book_discount', 'book_id', 'discount_id');
    }
}
