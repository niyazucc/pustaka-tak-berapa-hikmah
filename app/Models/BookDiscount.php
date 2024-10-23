<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDiscount extends Model
{
    use HasFactory;
    protected $table = 'book_discount';
    protected $fillable =[
        'book_id',
        'discount_id'
    ];
}
