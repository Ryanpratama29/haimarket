<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert(array(

        	['nama_perusahaan'=>'Haimart',
        	 'alamat'=>'Jl.Poros Malino,Pakatto Caddi',
        	 'telepon'=>'085397514424',
        	 'logo'=>'cos.png',
        	 'kartu_member'=>'cos.png',
        	 'diskon_member'=>'10',
        	 'tipe_nota'=>'0'
        	]	
        ));
    }
}
