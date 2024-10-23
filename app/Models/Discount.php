<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected $casts = [
        'book_id' => 'array',
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',

    ];
    public function book()
    {
        return $this->belongsToMany(Book::class, 'book_discount','discount_id','book_id');
    }
    public function scopeLatestDiscount(Builder $q): void
    {
        $q->latest('start_datetime');
    }
}
