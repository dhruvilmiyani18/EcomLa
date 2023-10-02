<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $catId = $request->category_id;

        if ($catId != null) {
            $Category = Category::where('category_id', $catId)->get();
            if ($Category->isEmpty() == false) {
                return response()->json([
                    "st"=>200,
                    "message" => "Success",
                    "data" => $Category
                ]);
            } else {
                return response()->json([
                    "st"=>200,
                    'message' => "Category Not Found"
                ]);
            }
        } else {
            $Category = Category::all();
            return response()->json([
                'status' =>200,
                "messsage"=>"success",
                "data"=>$Category
            ]);
        }
        return response()->json([
            'message' => "Invalide Request"
        ], 400);
    }

   
}
