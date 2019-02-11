<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert(array(
      	['name' =>'Daffa',
      	 'email'=>'daffa@gmail.com',
      	 'password'=>bcrypt('daffashidqi'),
      	 'foto'=>'cos.png',
      	 'level'=>1 
      	],

      	[ 'name' => 'Annisa Nabil',
      	  'email'=> 'Nabil@gmail.com',
      	  'password'=>bcrypt('annisanabil'),
      	  'foto'=>'cos.png',
      	  'level'=>2
      	],

        [ 'name' => 'Jumadil',
          'email'=> 'jumadil@gmail.com',
          'password'=>bcrypt('Nasrul'),
          'foto'=>'cos.png',
          'level'=>2
        ],

        [ 'name' => 'Nasrul',
          'email'=> 'Nasrul.com',
          'password'=>bcrypt('Nasrul'),
          'foto'=>'cos.png',
          'level'=>2
        ]



      ));
    }
}
