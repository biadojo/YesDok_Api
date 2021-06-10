<?php

namespace App\Http\Resources;

use App\Http\Resources\Mitra\ProdukItem;
use App\Models\Keranjang;
use Illuminate\Http\Resources\Json\JsonResource;

class Keranjangitem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pengguna = auth('pembeli')->user();
		$keranjang = Keranjang::where('pembeli_id', $pengguna->id)->first();
        return [
            'produk_id' => $keranjang,
            // 'pembeli_id' => $pengguna,
            'jumlah_produk' => $this->jumlah_produk,
        ];
    }
}
