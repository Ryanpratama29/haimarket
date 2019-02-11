<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member')->insert(array(
        	['kode_member' => '201',
        	 'nama' => 'Sandika Galih',
        	 'alamat' =>'jl.buah nangka',
        	 'telepon' =>'081354900735'
        	],

        	['kode_member' => '202',
        	 'nama' =>'Hilman Ramadhan',
        	 'alamat' =>'Jl.Duku Makassar',
        	 'telepon'=>'085397515454'
        	]

        ));
    }
}
