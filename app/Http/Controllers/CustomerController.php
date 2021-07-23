<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getAllCustomers(){
//
//        if(!Gate::allows('isAnalyst')){
//            abort(404, "sorry action not allowed");
//        }
        $customers = Customers::get()->toJson(JSON_PRETTY_PRINT);
        return response($customers, 200);
    }

    public function createCustomer(Request $request) {
        $customer = new Customers;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->company = $request->company;
        $customer->address = $request->address;
        $customer->mobile_num = $request->mobile_num;
        $customer->password = $request->password;
        $customer->save();

        return response()->json([
            "message" => "customer successfully created"
        ], 201);
    }

    public function getCustomer($id) {
        if(Customers::where('id', $id)->exists()){
            $customer = Customers::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($customer, 200);
        } else{
            return response()->json([
                "message" => "customer not found"
            ], 404);
        }
    }

    public function updateCustomer(Request $request, $id) {
        if (Customers::where('id', $id)->exists()) {
            $customer = Customers::find($id);
            $customer->name = is_null($request->name) ? $customer->name : $request->name;
            $customer->email = is_null($request->email) ? $customer->email : $request->email;
            $customer->company = is_null($request->company) ? $customer->company : $request->company;
            $customer->address = is_null($request->address) ? $customer->address : $request->address;
            $customer->mobile_num = is_null($request->mobile_num) ? $customer->mobile_num : $request->mobile_num;
            $customer->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Customer not found"
            ], 404);

        }
    }

    public function deleteCustomer($id) {
        if(Customers::where('id', $id)->exists()) {
            $customer = Customers::find($id);
            $customer->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Customer not found"
            ], 404);
        }
    }
}
