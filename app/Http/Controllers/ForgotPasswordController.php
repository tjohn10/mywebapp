<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    protected function sendResetLinkResponse(Request $request, $response){
        $response = ['message' => "Password rest Link sent"];
        return response($response, 200);
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        $response = "Email could not be sent to this email address";
        return response($response, 500);
    }
}
