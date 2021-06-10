<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdukCollection;
use App\Http\Resources\ProdukItem;
use App\Http\Response\BaseResponse;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function getproduk(Request $request){
        $paginate = 5;
        if($request->has('paginate'))
            $paginate = $request->paginate;

        $produk = new ProdukCollection(produk::orderBy('created_at', 'desc')->paginate($paginate));
        // $produk = Produk::orderBy('created_at', 'desc')->paginate($paginate);

        return BaseResponse::success(compact('produk'), 'Produk Berhasil Ditampilkan' );
	}

    public function detailproduk($id){
		$produk = produk::find($id);
		$produk = new ProdukItem($produk);
		return BaseResponse::success(compact('produk'));
	}
}
