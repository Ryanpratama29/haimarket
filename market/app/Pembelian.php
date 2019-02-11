<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';

    //memiliki relasi one to many dengan pembelian_detail artinya setiap pembelian terhadap supplier memiliki banyak detail_pembelian(artinya banyak produk didalamnya)

    //kita beri tahu bahwa tabel pembelian memiliki relasi one to many dengan memenuat fungsinya
    	/*
			parameternya
			1.model yang akan kita arahkan sebagai child
			2.foreignkey yang dimiliki oleh tabel child(dalam hal ini id_pembelian)
			3.primarykey yang dimiliki oleh parentnya(id_pembelian)

    	*/ 

	public function pembelian_detail(){
		return $this->hasMany(PembelianDetail::class,'id_pembelian','id_pembelian');
	}

}
