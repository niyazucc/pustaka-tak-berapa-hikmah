<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable= [
        'customer_id',
        'trackingno',
        'name','address','city','state','zip','country','phone_number',
        'orderstatus',
    ];

    public function users(){
        return $this->belongsTo(User::class,'customer_id');
    }
    public function orderitems(){
        return $this->hasMany(OrderItems::class, 'order_id');
    }
    public function addresses(){
        return $this->belongsTo(Addresses::class, 'addresses_id');
    }
}
