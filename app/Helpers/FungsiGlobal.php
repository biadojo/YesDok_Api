<?php

use \Illuminate\Support\Facades\Http;

function upload($file, $upload_location, $name = null, $old_file_path = null){
  if($name == null)
    $name = time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

  if($old_file_path)
    if(strpos($old_file_path, 'http') === false)
      unlink($old_file_path);

  $file_name = $name.'.'.$file->getClientOriginalExtension();
  $file->move($upload_location, $file_name);
  return $upload_location.'/'.$file_name;
}

function convertDate($date, $reverse = false, $toString = false){
  $date = explode('-', $date);
  if($reverse)
    $date = array_reverse($date);

  if($toString){
    switch ($date[1]){
      case '01': $date[1] = 'Januari'; break;
      case '02': $date[1] = 'Februari'; break;
      case '03': $date[1] = 'Maret'; break;
      case '04': $date[1] = 'April'; break;
      case '05': $date[1] = 'Mei'; break;
      case '06': $date[1] = 'Juni'; break;
      case '07': $date[1] = 'Juli'; break;
      case '08': $date[1] = 'Agustus'; break;
      case '09': $date[1] = 'September'; break;
      case '10': $date[1] = 'Oktober'; break;
      case '11': $date[1] = 'November'; break;
      case '12': $date[1] = 'Desember'; break;
    }

    $newDate = implode(' ', $date);
  }
  else{
    $newDate = implode('-', $date);
  }

  return $newDate;
}

function randomDate($start_date, $end_date, $format = 'Y-m-d H:i:s')
{
  // Convert to timetamps
  $min = strtotime($start_date);
  $max = strtotime($end_date);

  // Generate random number using above bounds
  $val = rand($min, $max);

  // Convert back to desired date format
  return date($format, $val);
}

function in_array_r($needle, $haystack, $strict = false) {
  foreach ($haystack as $item) {
    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
      return true;
    }
  }

  return false;
}

function rajaOngkirHeader(){
  return Http::withHeaders([
      'key' => config('services.rajaongkir.api'),
      'Content-Type' => 'application/x-www-form-urlencoded'
  ]);
}

function getProvinsi($id = null){
  return rajaOngkirHeader()->get('https://api.rajaongkir.com/starter/province', compact('id'))->json()['rajaongkir']['results'];
}

function getKota($id = null, $province = null){
  return rajaOngkirHeader()->get('https://api.rajaongkir.com/starter/city', compact('province','id'))->json()['rajaongkir']['results'];
}

function rupiah_format($harga){
  return number_format((float)$harga, 2, ',', '.');
}

function initNexmo(){
  $basic  = new \Nexmo\Client\Credentials\Basic(
      config('nexmo.api_key'),
      config('nexmo.api_secret')
  );
  $client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));
  return $client;
}

function kirimVerifikasiSMS($no_hp){
  $client = initNexmo();

  if(substr($no_hp, 0, 1) == '0'){
    $no_hp = substr_replace($no_hp, '62', 0,1);
  }
  // 9 : Your pre-pay account does not have sufficient credit to process this message
  // 10 : Concurrent verifications to the same number are not allowed
  try{
    $verification = $client->verify()->start([
        'number' => $no_hp,
        'brand'  => config('app.name'),
        'code_length'  => '4']);
    return $verification->getRequestId();
  }
  catch (Exception $e){
    return $e;
  }
}

function cekVerifikasiSMS($pin, $request_id){
  $client = initNexmo();
  $verification = new \Nexmo\Verify\Verification($request_id);

  // 0 : sukses
  // 6 : sudah diverifikasi atau request tidak ada
  // 16 : PIN salah
  try {
    $result = $client->verify()->check($verification, $pin);

    return $result->getStatus();
  }
  catch(Exception $e) {
    return $e;
  }
}
function cancelVerifikasiSMS($req_id){
  $client = initNexmo();

  // 6 : The requestId '6b8d1af7c52c4dc9b006d7c6dc758154' does not exist or its no longer active.
  // 19 : "Verification request ['d6bf8140f76d4b20aaeb2319b7cdb326'] can't be cancelled within the first 30 seconds.
  try {
    $result = $client->verify()->cancel($req_id);
    return [
        'code' => 0,
        'status' => 'Success'
    ];
  }
  catch(Exception $e) {
    return [
        'code' => $e->getCode(),
        'error' => $e->getMessage()
    ];
  }
}
