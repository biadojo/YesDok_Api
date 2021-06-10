<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cashier_id');
            $table->string('nama_produk', 150);
            $table->text('deskripsi');
            $table->integer('harga_satuan');
            $table->smallInteger('stok_produk');
            $table->mediumText('foto_produk')->nullable();
            $table->enum('status_verifikasi', ['0', '1', '-1']);
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
            $table->foreign('cashier_id')->references('id')->on('cashier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
