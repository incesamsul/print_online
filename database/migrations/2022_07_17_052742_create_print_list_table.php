<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_list', function (Blueprint $table) {
            $table->increments('id_print_list');
            $table->unsignedBigInteger('id_user');
            $table->unsignedInteger('id_produk');
            $table->string('file');
            $table->enum('read', ['0', '1'])->default('0');
            $table->enum('status_print', ['ready', 'antri', 'proses', 'selesai'])->default('ready');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_list');
    }
}
