<?php

use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk')->insert(array(
        	[

        		'kode_produk' => '2016',
        		'id_kategori' => '1',
        		'nama_produk' => 'sikat gigi',
        		'merk'		  => 'pepsodent',
        		'harga_beli'  => '2000',
        		'diskon'	  => '20',
        		'stok'		  => '22'
        	],

        	[

        		'kode_produk' => '2017',
        		'id_kategori' => '12',
        		'nama_produk' => 'kue bolu',
        		'merk'		  => 'kerupuk',
        		'harga_beli'  => '2000',
        		'diskon'	  => '12',
        		'stok'		  => '23'
        	]


        ));
    }
}
