<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

    class Product extends Model
    {
        use HasFactory;
        protected $guarded = [];

        public function category(){
            return $this->belongsTo(Category::class,'category_id');
        }
        public function product_details(){
            return $this->hasOne(ProductDetails::class);
        }
    }
