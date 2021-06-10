<?php

namespace App\Http\Resources;

use App\Models\Cashier;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $cashieer = Cashier::where('id', $this->cashier_id)->first();
        return [
            'id' => $this->id,
            'Cashier' => $cashieer,
            'nama_produk' => $this->nama_produk,
            'deskripsi' => $this->deskripsi,
            'harga_satuan' => $this->harga_satuan,
            'stok_produk' => $this->stok_produk,
            'foto_produk' => $this->foto_produk,
            'status_verifikasi' => $this->status_verifikasi,
            'alasan_penolakan' => $this->alasan_penolakan
        ];
    }
}
