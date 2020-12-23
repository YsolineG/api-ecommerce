<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {

     $customers = Customer::all();

     return response()->json($customers);

    }

    public function create(Request $request)
    {
        // valider les données reçues dans la requête $request
        $this->validate($request, [
            'name' => 'required|max:100',
            'firstname' => 'required|max:100',
            'email'=> 'required|max:100',
            'address' => 'required|max:255',
        ]);

        $customers = new Customer;

        $customers->name= $request->name;
        $customers->firstname= $request->firstname;
        $customers->email= $request->email;
        $customers->address= $request->address;

        $customers->save();

        return response()->json($customers);
    }

    public function show($id)
    {
        $customers = Customer::find($id);

        return response()->json($customers);
    }

    public function update(Request $request, $id)
    {
        $customers= Customer::find($id);

        if ($customers === null) {
            return response()->json('customer does not exist');
        }

        if(!empty($request->name)) {
            $this->validate($request, [
                'name' => 'required|max:100'
            ]);
            $customers->name = $request->name;
        }

        if(!empty($request->firstname)){
            $this->validate($request, [
                'firstname' => 'required|max:100'
            ]);
            $customers->firstname = $request->firstname;
        }

        if(!empty($request->email)){
            $this->validate($request, [
                'email' => 'required|max:100'
            ]);
            $customers->email = $request->email;
        }

        if(!empty($request->address)){
            $this->validate($request, [
                'address' => 'required|max:255'
            ]);
            $customers->address = $request->address;
        }

        $customers->save();
        return response()->json($customers);
    }

    public function destroy($id)
    {
        $customers = Customer::find($id);

        if ($customers === null) {
            return response()->json('customer does not exist');
        }

        $customers->delete();

        return response()->json('customer removed successfully');
    }
}
