<?php

namespace App\Repositories;
use App\Models\Produk;
use Illuminate\Support\Str;
use App\Http\Response\BaseResponse;
use Illuminate\Support\Facades\Hash;

class ProdukRepository{
    
	public static function StoreProduk(array $data){
        $Cashier = auth('cashier')->user();
        $de = upload($data['foto_produk'], 'img/produk');
		$produk = Produk::create([
            'cashier_id' => $Cashier->id,
            'nama_produk' => $data['nama_produk'],
            'deskripsi' => $data['deskripsi'],
            'harga_satuan' => $data['harga_satuan'],
            'stok_produk' => $data['stok_produk'],
            'foto_produk' => $de,
            'status_verifikasi' => '0',
        ]);

		return BaseResponse::success(compact('produk'));
	}

	public static function UpdateProduk(array $data, $id){
        $Cashier = auth('cashier')->user();
        $produk = Produk::find($id);
		if (!$produk->foto_produk) {
            $data['foto_produk'] = upload($data['foto_produk'], 'img/produk');
        }else {
            # code...
            $data['foto_produk'] = upload($data['foto_produk'], 'img/produk', $produk->foto_produk);
        }

		$produk->update($data);
		return BaseResponse::success(compact('produk'));	
	}

	public static function VerifikasiProduk(array $data, $id){
        $produk = Produk::find($id);

		$produk->update($data);
		return BaseResponse::success(compact('produk'));	
	}

}