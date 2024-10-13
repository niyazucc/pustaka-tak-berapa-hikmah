<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id',
        'bookid',
        'quantity',
        'price',
        'total',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function books()
    {
        return $this->belongsTo(Book::class,'bookid');
    }
}
