<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
     
     $categories = Category::all();

     return response()->json($categories);

    }

    public function create(Request $request)
    {
        // valider les données reçues dans la requête $request
        $this->validate($request, [
            'name' => 'required|unique:categories|max:100',
        ]);

        $category = new Category;

        $category->name= $request->name;

        $category->save();

        return response()->json($category);
    }

    public function show($id)
    {
        $category = Category::find($id);
        $category->products = $category->products;

        return response()->json($category);
    }

    public function update(Request $request, $id)
    { 
        $this->validate($request, [
            'name' => 'required|unique:categories|max:100',
        ]);

        $category= Category::find($id);

        if ($category === null) {
            return response()->json('category does not exist');
        }
        
        $category->name = $request->name;
        $category->save();
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category === null) {
            return response()->json('category does not exist');
        }

        $category->delete();

        return response()->json('category removed successfully');
    }

    public function showProducts($id) {
        $category = Category::find($id);

        if ($category === null) {
            return response()->json('category$category does not exist');
        }

        return response()->json($category->products);
    }

    public function createProducts($id, Request $request)
    {
        $category = Category::find($id);

        $category->categories()->attach($request->product_id);

        return response()->json($category->products);

    }
}