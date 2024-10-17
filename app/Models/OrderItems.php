<?php

namespace App\Models;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'book_id',
        'quantity',
        'price',
        'total'
    ];

    public function orders(){
     return $this->belongsTo(Orders::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id'); // Define the relationship to the Book model
    }
}
