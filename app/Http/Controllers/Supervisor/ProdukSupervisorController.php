<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupervisorProdukRequest;
use App\Http\Resources\ProdukCollection;
use App\Http\Response\BaseResponse;
use App\Models\Produk;
use App\Repositories\ProdukRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukSupervisorController extends Controller
{
    public function getproduk(Request $request){
        $paginate = 10;
        if($request->has('paginate'))
            $paginate = $request->paginate;

        $produk = new ProdukCollection(Produk::where(['status_verifikasi' => '0'])->orderBy('created_at', 'desc')->paginate($paginate));

        return BaseResponse::success(compact('produk'), 'Produk Berhasil Ditampilkan' );
	}

    public function ListprodukVerifikasi(Request $request){
        $paginate = 10;
        if($request->has('paginate'))
            $paginate = $request->paginate;

        $produk = new ProdukCollection(Produk::where(['status_verifikasi' => '1'])->orderBy('created_at', 'desc')->paginate($paginate));

        return BaseResponse::success(compact('produk'), 'Produk Berhasil Ditampilkan' );
	}

    public function VerikasiProduk(SupervisorProdukRequest $request, $id){
    	DB::beginTransaction();
    	try{
    		$response = ProdukRepository::VerifikasiProduk($request->validated(), $id);
    		DB::commit();
    		return $response;
    	}catch(\Throwable $e){
    		DB::rollback();
    		return $e->getMessage();
    	}
	}
}
