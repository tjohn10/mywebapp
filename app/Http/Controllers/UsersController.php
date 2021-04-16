<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getAllUsers() {
        $users = User::get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);
    }

    public function createUser(Request $request) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->name;
        $user->mobile_num = $request->mobile_num;
        $user->type = $request->type;
        $user->profile = $request->profile;
        $user->password = $request->password;
        $user->save();

        return response()->json([
            "message" => "user created successfully"
        ], 201);
    }

    public function getUser($id) {
        if(User::where('id', $id)->exists()) {
            $user = User::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($user, 200);
        } else {
            return response()->json([
                "message" => "user does not exist"
            ],404);
        }
    }

    public function updateUser(Request $request, $id) {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->mobile_num = is_null($request->mobile_num) ? $user->mobile_num : $request->mobile_num;
            $user->type = is_null($request->type) ? $user->type : $request->type;
            $user->profile = is_null($request->profile) ? $user->profile : $request->profile;
            $user->password = is_null($request->password) ? $user->password : $request->password;
            $user->save();

            return response()->json([
                "message" => "user updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    public function deleteUser($id){
        if(User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                "message" => "user deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }
    }
}
