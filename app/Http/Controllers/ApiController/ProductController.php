<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){
       $catId = $request->category_id;

       if($catId !== null){
           $products = Product::where('category_id',$catId)->get();
           return response()->json([
            'status' =>200,
                "messsage"=>"success",
                "data"=>$products
           ]);
       }
       else{
           $products = Product::all();
           return response()->json([
            'status' =>200,
                "messsage"=>"All Products Details ",
                "data"=>$products
           ]);
       }
       
       return response()->json([
        'message' => 'Invalid Request',
       ]);

    }
}
