<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'name',
        'phone_number',
        'address',
        'city',
        'state',
        'zip',
        'country',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
