<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
     
     $products = Product::paginate(15);

     return response()->json($products);

    }

    public function create(Request $request)
    {
        // valider les données reçues dans la requête $request
        $this->validate($request, [
            'name' => 'required|unique:products|max:100',
            'price' => 'required|digits_between:0,2',
            'description' => 'required|max:255',
            'stock' => 'required|integer'
        ]);

        $product = new Product;

        $product->name= $request->name;
        $product->price = $request->price;
        $product->description= $request->description;
        $product->stock= $request->stock;

        $product->save();

        return response()->json($product);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $product->categories = $product->categories;

        return response()->json($product);
    }

    public function update(Request $request, $id)
    { 

        $product= Product::find($id);

        if ($product === null) {
            return response()->json('product does not exist');
        }

        if(!empty($request->name)){
            $this->validate($request, [
                'name' => 'required|unique:products|max:100',
            ]);
            $product->name = $request->name;
        }

        if(!empty($request->price)){
            $this->validate($request, [
                'price' => 'required|digits_between:0,2',
            ]);
            $product->price = $request->price;
        }

        if(!empty($request->description)){
            $this->validate($request, [
                'description' => 'required|max:255',
            ]);
            $product->description = $request->description;
        }

        $product->save();
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product === null) {
            return response()->json('product does not exist');
        }

        $product->delete();

        return response()->json('product removed successfully');
    }

    public function createCategories($id, Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:App\Models\Category,id',
        ]);

        $product = Product::find($id);

        $product->categories()->attach($request->category_id);

        return response()->json($product->categories);

    }

    public function showCategories($id) {
        $product = Product::find($id);

        if ($product === null) {
            return response()->json('product does not exist');
        }

        return response()->json($product->categories);
    }
}