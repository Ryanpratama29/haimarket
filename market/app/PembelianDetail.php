<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    protected $table = 'pembelian_detail';
    protected $primaryKey = 'id_pembelian_detail';

    // public function pembelian(){
    // 	//belongsTo atinya si model profil ini kita tempatkan dengan model User
    // 	return $this->belongsTo(Pembelian::class);
    // }
}
