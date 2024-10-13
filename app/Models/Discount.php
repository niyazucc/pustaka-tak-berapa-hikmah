<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'description',
        'discount_rate',
        'start_datetime',
        'end_datetime'
    ];
    protected $cast = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',

    ];
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
