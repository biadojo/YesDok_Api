<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Http\Resources\ProdukCollection;
use App\Http\Response\BaseResponse;
use App\Models\Produk;
use App\Repositories\ProdukRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangCashierController extends Controller
{

    public function getproduk(Request $request){
        $paginate = 10;
        if($request->has('paginate'))
            $paginate = $request->paginate;

        $produk = new ProdukCollection(Produk::where(['cashier_id' => auth('cashier')->id()])->orderBy('created_at', 'desc')->paginate($paginate));

        return BaseResponse::success(compact('produk'), 'Produk Berhasil Ditampilkan' );
	}

    public function ListProdukTolak(Request $request){
        $paginate = 10;
        if($request->has('paginate'))
            $paginate = $request->paginate;

        $produk = new ProdukCollection(Produk::where(['cashier_id' => auth('cashier')->id()], ['status_verifikasi' => '-1'])->orderBy('created_at', 'desc')->paginate($paginate));

        return BaseResponse::success(compact('produk'), 'Produk Berhasil Ditampilkan' );
	}

    public function ListProdukVerifikasi(Request $request){
        $paginate = 10;
        if($request->has('paginate'))
            $paginate = $request->paginate;

        $produk = new ProdukCollection(Produk::where(['cashier_id' => auth('cashier')->id()], ['status_verifikasi' => '1'])->orderBy('created_at', 'desc')->paginate($paginate));

        return BaseResponse::success(compact('produk'), 'Produk Berhasil Ditampilkan' );
	}
    
    public function AddProduk(ProdukRequest $request){
    	DB::beginTransaction();
    	try{
    		$response = ProdukRepository::StoreProduk($request->validated());
    		DB::commit();
    		return $response;
    	}catch(\Throwable $e){
    		DB::rollback();
    		return $e->getMessage();
    	}
	}

    public function UpdateProduk(ProdukRequest $request, $id){
    	DB::beginTransaction();
    	try{
    		$response = ProdukRepository::UpdateProduk($request->validated(), $id);
    		DB::commit();
    		return $response;
    	}catch(\Throwable $e){
    		DB::rollback();
    		return $e->getMessage();
    	}
	}
}
