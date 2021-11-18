<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\AssignedOrder;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\Service;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Orders::with(['customer'])->get();
        return response($orders, 200);
    }

    public function store(Request $request)
    {
        $order_id = Helper::IDGenerator(new Orders, 'order_id', 5, 'ORD');
        $order = new Orders();
        $order->order_id = $order_id;
        $order->name = $request->name;
        $order->customer_id = $request->customer_id;
        $order->service = $request->service;
        $order->delivery_date = $request->delivery_date;
        $order->payment_option = $request->payment_option;
        $order->order_status = $request->order_status;

        $order->save();

        return response()->json([
            "message" => "order successfully created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function getOrder($id)
    {
        $order = Orders::find($id);
        return view('show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $order = Orders::find($id);
        return view('edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $order = Orders::find($id);
        $order->delivery_date = Input::get('delivery_date');
        $order->product_id = Input::get('product_id');
        $order->payment_option = Input::get('payment_option');
        $order->order_status = Input::get('order_status');

        if ($order->save()) {
            Session::flash('message', 'Order was successfully updated');
            Session::flash('m-class', 'alert-success');
            return redirect('order');
        } else {
            Session::flash('message', 'Data is not saved');
            Session::flash('m-class', 'alert-danger');
            return redirect('order/create');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Orders::find($id)->delete();

        Session::flash('message', 'Order was successfully deleted');
        Session::flash('m-class', 'alert-success');
        return redirect('order');
    }

    public function assign(array $params) {
        foreach($params['assigned_orders'] as $assignedOrder) {
            AssignedOrder::updateOrCreate([
                'order_id'=> $assignedOrder->order_id,
                'assigned_to'=> $assignedOrder->assigned_to
            ], [
                'assigned_by'=> auth()->id(),
                'completed_at'=> now()
            ]);
        }
    }
}
