<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Response\BaseResponse;
use Illuminate\Http\Request;

class LoginStaffController extends Controller
{
    public function login(Request $request){
        if($token = auth('staff')->attempt($request->all()))
          return BaseResponse::responseRegister($token, 'staff');
        else
          return BaseResponse::unauthenticated('E-mail atau password salah');
    }
}
