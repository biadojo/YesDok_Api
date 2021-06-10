<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Response\BaseResponse;
use Illuminate\Http\Request;

class LoginCashierController extends Controller
{
    public function login(Request $request){
        if($token = auth('cashier')->attempt($request->all()))
          return BaseResponse::responseRegister($token, 'cashier');
        else
          return BaseResponse::unauthenticated('E-mail atau password salah');
    }
}
