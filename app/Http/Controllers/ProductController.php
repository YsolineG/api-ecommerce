<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
     
     $products = Product::all();

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
}