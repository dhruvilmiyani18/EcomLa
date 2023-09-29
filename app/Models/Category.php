<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // protected $guarded = [];
    protected $fillable = ['category_id', 'name'];
    protected $table = "categories";
    protected $primaryKey = "id";

    public function parent_category(){
        return $this->belongsTo(Category::class,'category_id');
    }

}
