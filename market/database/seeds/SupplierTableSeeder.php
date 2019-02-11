<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supplier')->insert(array(
        	['nama' => 'Ryan',
        	 'alamat'=>'Jl.Poros Malino Pakatto',
        	 'telepon'=>'081354900735'
        	],

        	['nama'=>'Judika',
        	 'alamat'=>'jl.kemayoran lama jakarta',
        	 'telepon'=>'085397514424'
        	]

        ));
    }
}
