<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UbahTabelProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('produk',function(Blueprint $table){
          $table->bigInteger('harga_jual')->after('diskon');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('harga_jual');
        });
    }
}
