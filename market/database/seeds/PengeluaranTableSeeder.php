<?php

use Illuminate\Database\Seeder;

class PengeluaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengeluaran')->insert(array(

        	['jenis_pengeluaran'=>'sewa listrik',
        	 'nominal'=>'2000000'
        	],

        	[
        	 'jenis_pengeluaran'=>'sewa panggung',
        	 'nominal' => '3000000'
        	]
        	
        ));
    }
}
