<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert(array(
        	[
				'nama_kategori'=>'Perlengkapan kebersihan',
			],

			[
				'nama_kategori'=>'Makanan',
			],

			[
				'nama_kategori' =>'Minuman',
			]

		));
    }
}
