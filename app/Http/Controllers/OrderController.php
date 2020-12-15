<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
     
     $orders = Order::all();
     $orders = DB::table('orders')->simplePaginate(15);

     return response()->json($orders);

    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:App\Models\Customer,id',
        ]);

        $order = new Order;

        $order->customer_id= $request->customer_id;

        $order->save();

        return response()->json($order);
    }

    public function show($id)
    {
        $order = Order::find($id);
        $order->products = $order->products;

        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order === null) {
            return response()->json('order does not exist');
        }

        $order->delete();

        return response()->json('order removed successfully');
    }

    public function showProducts($id) {
        $order = Order::find($id);

        if ($order === null) {
            return response()->json('order does not exist');
        }

        return response()->json($order->products);
    }

    public function createProduct($id, Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:App\Models\Product,id',
            'quantity' => 'required|integer',
            'order_id' => 'required|exists:App\Models\Order,id'
        ]);

        $order = Order::find($id);

        $order->products()->attach($request->product_id, ['quantity' => $request->quantity]);

        return response()->json($order->products);

    }

    public function updateProduct($id, Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:App\Models\Product,id',
            'quantity' => 'required|integer',
        ]);

        $order = Order::find($id);

        if ($order === null) {
            return response()->json('order does not exist');
        }

        if(!empty($request->quantity) && !empty($request->product_id)){
            $this->validate($request, [
                'product_id' => 'required|exists:App\Models\Product,id',
                'quantity' => 'required|integer',
            ]);

            $order->products()->attach($request->product_id, ['quantity' => $request->quantity]);
        }

        return response()->json($order);
    }

    public function destroyProduct($id, Request $request) 
    {
        $order = Order::find($id);

        if ($order === null) {
            return response()->json('order does not exist');
        }

        $order->products()->detach($request->product_id);

        return response()->json($order->products);
        
    }
}