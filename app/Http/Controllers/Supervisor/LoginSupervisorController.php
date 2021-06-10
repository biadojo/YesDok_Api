<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Http\Response\BaseResponse;
use Illuminate\Http\Request;

class LoginSupervisorController extends Controller
{
    public function login(Request $request){
        if($token = auth('supervisor')->attempt($request->all()))
          return BaseResponse::responseRegister($token, 'supervisor');
        else
          return BaseResponse::unauthenticated('E-mail atau password salah');
    }
}
