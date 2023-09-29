<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ?? '';
        $categories = Category::whereNotNull('category_id')->get();
        $product = Product::paginate(5);
        $data = compact('categories', 'product', 'search');
        return view('admin.products.add')->with($data);
    }

    public function search_product(Request $request)
    {
        $search = $request->input('search') ?? '';
        $product = Product::where('name', 'LIKE', "%$search%")->paginate(5);
        $categories = Category::whereNotNull('category_id')->get();
        $data = compact('product', 'search','categories');
        return view('admin.products.add')->with($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'price' => ['required', 'integer'],
            'category_id' => 'required',
            'image' => 'required|max:10000',
        ]);

        // Handle the image upload and store it in the 'uploads' directory
        $filepath = time() . '-product.' . $request->file('image')->getClientOriginalExtension();
        $imgStore = $request->image->move(public_path('uploads'), $filepath);

        // Create a new product record in the database
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $filepath,
            'category_id' => $request->category_id,
        ];

        Product::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        $categories = Category::whereNotNull('category_id')->get();
        $data = compact('product', 'categories');
        return view('admin.products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $id = $request->id;

        $data = array(
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id
        );
    //    dd($request->file('image'));
    if($request->hasFile('image')){
            $filepath = time() . '-product.' . $request->file('image')->getClientOriginalExtension();
            $ImgStore = $request->image->move(public_path('uploads'), $filepath);
            $data['image'] = $filepath;
        // dd($data);       
    }

        Product::where('id', $id)->update($data);
        return redirect()->route('add.product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        // Find the product and its associated product details
        $product = Product::find($id);
        $productDetails = $product->product_details;

        // Delete the associated product details
        if ($productDetails) {
            $productDetails->delete();
        }
        // Now you can safely delete the product
        $product->delete();

        return redirect()->back();
    }


    // product details routes

    public function product_details(Request $request)
    {
        $id = $request->id;
        //product data with productdetails data use hasone reletionsip (product table)
        $product = Product::where('id', $id)->with('product_details')->first();

        if (!is_null($product) && !is_null($product->product_details)) {
            $images = json_decode($product->product_details->image);
        } else {
            $images = null;
        }
        $data = compact('id', 'product', 'images');
        return view('admin.products.extra_details')->with($data);
    }
    public function product_details_store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'title' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'product_id' => 'required',
            'image' => 'required|max:10000',
        ]);

        // dd($request->image);
        $data = array(
            'title' => $request->title,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => json_encode($request->image),
            'product_id' => $request->product_id,
        );
        ProductDetails::create($data);
        return redirect()->route('add.product')->with('status', 'Product Extra Details Add Successfully !!');
    }

    //dropzon img controller
    public function storeMedia(Request $request)
    {

        $path = public_path('/productmulti_img');
        // dd($path);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
