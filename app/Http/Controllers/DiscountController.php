<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function listalldiscount(){
        return view('admin.discount');
    }
    public function create(){
        $discount = null;
        return view('admin.creatediscount',compact('discount'));
    }
    public function edit($id){
        $discount = Discount::findOrFail($id);
        return view('admin.creatediscount',compact('discount'));
    }
}
