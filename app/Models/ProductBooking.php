<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBooking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function product_details()
    {
        return $this->hasOne(ProductDetails::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
