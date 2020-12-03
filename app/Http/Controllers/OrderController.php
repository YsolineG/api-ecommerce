<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;


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

     return response()->json($orders);

    }

    public function create(Request $request)
    {

        $order = new Order;

        $order->customer_id= $request->customer_id;

        $order->save();

        return response()->json($order);
    }

    public function show($id)
    {
        $order = Order::find($id);

        return response()->json($order);
    }

    public function update(Request $request, $id)
    { 
        $order= Order::find($id);

        $order->customer_id = $request->customer_id;
        $order->save();
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order === null) {
            return response()->json('order does not exist');
        }

        $order->delete();

        return response()->json('product removed successfully');
    }
}