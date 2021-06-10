<?php

namespace App\Http\Response;

class BaseResponse
{
  public static function response(int $status, $data = null, $message = null){
    $response = compact('status', 'message');

    if($data)
      $response += $data;

    return response()->json($response, $status);
  }

  public static function success($data = null, $customMessage = null){
    $customMessage = $customMessage ? $customMessage : 'Success';
    return self::response(200, $data, $customMessage);
  }

  public static function responseRegister($token, $guard = 'api'){
    $data = [
        'access_token' => $token,
        'token_type'   => 'Bearer',
        'user' => auth($guard)->user(),
        'expires_in'   => auth($guard)->factory()->getTTL() * 60,
    ];

    return self::success(compact('data'));
  }

  public static function badRequest($data = null, $customMessage = null){
    $customMessage = $customMessage ? $customMessage : 'Bad Request';
    return self::response(400, $data, $customMessage);
  }

  public static function unprocessableEntity($data = null, $customMessage = null){
    $customMessage = $customMessage ? $customMessage : 'Unprocessable Entity';
    return self::response(422, $data, $customMessage);
  }

  public static function internalServerError($data = null, $customMessage = null){
    $customMessage = $customMessage ? $customMessage : 'Internal Server Error';
    return self::response(500, $data, $customMessage);
  }

  public static function notFound($customMessage = null){
    $customMessage = $customMessage ? $customMessage : 'Not Found';
    return self::response(404, null, $customMessage);
  }

  public static function unauthenticated($customMessage = null){
    $customMessage = $customMessage ? $customMessage : 'Unauthenticated';
    return self::response(401, null, $customMessage);
  }
}
