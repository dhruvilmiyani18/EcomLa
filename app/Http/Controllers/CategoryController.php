<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $category = Category::where('status', '1')->paginate(10);
        $categories = Category::whereNull('category_id')->get();
        $data = compact('categories', 'category','search');
        return view('admin.categories.add')->with($data);
    }

    public function search_category(Request $request)
    {
        $search = $request->input('search') ?? '';
        $category = Category::where('name', 'LIKE', "%$search%")->paginate(10);
        $categories = Category::whereNull('category_id')->get();
        $data = compact('categories', 'category', 'search');
        return view('admin.categories.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retrieve data from the request
        $name = $request->input('name');
        $category_id = $request->input('category_id');

        // Create a new Category instance
        $category = new Category();
        $category->name = $name;
        $category->category_id = $category_id;

        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edite($id)
    {
        
        $categories = Category::whereNull('category_id')->get();
        // dd($category);
        $category = Category::find($id);
        $data = compact('categories', 'category');
        return view('admin.categories.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all());
        $id =  $request->id;
        $data = array(
            'category_id' => $request->category_id,
            'name' => $request->name,
        );
        // dd($data);
         Category::find($id)->update($data);
        return redirect()->route('add.category');
    }
    public function delete(Request $request)
    {
        //    dd($id); 
        $id = $request->id;
        // dd($id);
        $data = Category::where('id', $id)->first();
        $data->delete();
        return redirect()->route('add.category');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
    }
}
