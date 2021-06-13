<?php

namespace App\Http\Controllers;

use App\Models\WorkOrders;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function index()
    {
        $workorders = WorkOrders::with(['user', 'service'])->get();
        return response($workorders, 200);
    }

    public function createWorkOrder(Request $request)
    {
        $workorders = new WorkOrders();
        $workorders->order_name = $request->order_name;
        $workorders->user_id = $request->user_id;
        $workorders->service_id = $request->service_id;
        $workorders->delivery_date = $request->delivery_date;
        $workorders->payment_option = $request->payment_option;
        $workorders->order_status = $request->order_status;

        $workorders->save();

        return response()->json([
            "message" => "Workorder successfully created"
        ], 201);
    }

    public function updateWorkOrder(Request $request, $id) {
        if  (WorkOrders::where('id', $id)->exists()) {
            $workorders = WorkOrders::find($id);
            $workorders->order_name = is_null($request->order_name) ? $workorders->order_name : $request->order_name;
            $workorders->user_id = is_null($request->user_id) ? $workorders->user_id : $request->user_id;
            $workorders->service_id = is_null($request->service_id) ? $workorders->service_id : $request->service_id;
            $workorders->delivery_date = is_null($request->delivery_date) ? $workorders->delivery_date : $request->delivery_date;
            $workorders->payment_option = is_null($request->payment_option) ? $workorders->payment_option : $request->payment_option;;
            $workorders->order_status = is_null($request->order_status) ? $workorders->order_status : $request->order_status;

            return response()->json([
                "message" => "workorder updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Workorder not found"
            ], 404);
        }
    }
}
