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

        $orders = new Order;

        $orders->date= $request->date;

        $orders->save();

        return response()->json($orders);
    }

    public function show($id)
    {
        $orders = Order::find($id);

        return response()->json($orders);
    }

    public function update(Request $request, $id)
    { 
        $orders= Order::find($id);

        $orders->date = $request->input('date');
        $orders->save();
        return response()->json($orders);
    }

    public function destroy($id)
    {
        $orders = Order::find($id);

        if ($orders === null) {
            return response()->json('order does not exist');
        }

        $orders->delete();

        return response()->json('product removed successfully');
    }
}