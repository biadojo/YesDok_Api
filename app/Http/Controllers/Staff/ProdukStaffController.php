<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukCollection;
use App\Http\Response\BaseResponse;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukStaffController extends Controller
{
    public function getproduk(Request $request){
        $paginate = 10;
        if($request->has('paginate'))
            $paginate = $request->paginate;

        $produk = new ProdukCollection(Produk::where(['status_verifikasi' => '1'])->orderBy('created_at', 'desc')->paginate($paginate));

        return BaseResponse::success(compact('produk'), 'Produk Berhasil Ditampilkan' );
	}
}
