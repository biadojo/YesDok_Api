<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cashier_id' => $this->faker->numberBetween(1, \App\Models\Cashier::count()),
            'nama_produk' => $this->faker->words(3, true),
            'deskripsi' => $this->faker->paragraph,
            'harga_satuan' => $this->faker->randomNumber(3, true),
            'stok_produk' => $this->faker->randomNumber(2, true),
            'foto_produk' => 'https://picsum.photos/200/300',
            'status_verifikasi' => $this->faker->randomElement(['0', '1', '-1']),
        ];
    }
}
