<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function getAllServices(){
        $services = Service::get()->toJson(JSON_PRETTY_PRINT);
        return response($services, 200);
    }

    public function store(Request $request) {
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->save();

        return response()->json([
            "message" => "service successfully created"
        ], 201);
    }

    public function getService($id) {
        if(Service::where('id', $id)->exists()){
            $service = Service::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($service, 200);
        } else{
            return response()->json([
                "message" => "services not found"
            ], 404);
        }
    }

    public function updateService($id, Request $request){
        if(Service::where('id', $id)->exists()){
            $service = Service::find($id);
            $service->name = is_null($request->name) ? $service->name : $request->name;
            $service->description = is_null($request->descripton) ? $service->description : $request->description;
            $service->save();

            return response()->json([
                "message" => "service updated successfully"
            ], 200);
        }else {
            return response()->json([
                "message" => "service not found"
            ], 404);
        }
    }

    public function deleteService($id)
    {
        if (Service::where('id', $id)->exists()) {
            $service = Service::find($id);
            $service->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Service not found"
            ], 404);
        }
    }
}
