<?php

namespace App\Http\Controllers;

use App\Http\Response\BaseResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
        if($token = auth('pembeli')->attempt($request->all()))
          return BaseResponse::responseRegister($token, 'pembeli');
        else
          return BaseResponse::unauthenticated('E-mail atau password salah');
    }
}
