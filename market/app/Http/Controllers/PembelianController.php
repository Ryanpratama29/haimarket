<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Pembelian;
use App\Supplier;
use App\PembelianDetail;
use App\Produk;

class PembelianController extends Controller
{	
	//digunakan untuk mengrimkan data supplier untuk ditampilkan pada modal supplier yang akan tampil ketika kita membuat transaksi baru.jadi sebelum membuat transaksi pembelian.kita harus pilih suppliernya

    public function index(){
    	$supplier = Supplier::all();
    	return view('pembelian.index',compact('supplier'));
    }


    //digunakan untuk manampilkan data pembelian terhadap supplier
    public function listData(){
    	$pembelian = Pembelian::leftJoin('supplier','supplier.id_supplier','=','pembelian.id_supplier')
    		->orderBy('pembelian.id_pembelian','desc')
    		->get();

    	$no = 0;
    	$data = array();

    	foreach($pembelian as $list){
    		$no++;
    		$row   = array();
    		$row[] = $no;
    		$row[] = tanggal_indonesia(substr($list->created_at,0,10),false);
    		$row[] = $list->nama;d
    		$row[] = $list->total_item;
    		$row[] = "Rp.".format_uang($list->total_harga);
    		$row[] = $list->diskon."%";
    		$row[] = "Rp.".format_uang($list->bayar);
    		$row[] = '<div class="btn-group">
    					<a onclick="showDetail('.$list->id_pembelian.')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
    					<a onclick="deleteData('.$list->id_pembelian.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
    				 </div>';

    		$data[] = $row;
    	}

    	$output = array("data"=>$data);
    	return response()->json($output);

    }


    //digunakan untuk menampilkan tabel pembelian detail ketika user menekan tombol showDetail
    public function show($id){
        $detail = PembelianDetail::leftJoin('produk','produk.kode_produk','=','pembelian_detail.kode_produk')
                    ->where('id_pembelian','=',$id)
                    ->get();
                $no = 0;
                $data = array();
                foreach($detail as $list){
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $list->kode_produk;
                    $row[] = $list->nama_produk;
                    $row[] = "Rp.".format_uang($list->harga_beli);
                    $row[] = $list->jumlah;
                    $row[] = "Rp.".format_uang($list->harga_beli * $list->jumlah);

                    $data[] = $row;
                }
                $output = array("data" => $data);
                return response()->json($output);
    }

    //digunakan untuk menyimopan data pembelian baru tetapi hanya mengisi suppliernya sja,sementara yang lain akan diisi dengan nol dan akan diupdate ketika menyimpan data transaksi yaitu pada method store.$id berisi data supplier yang diterima dari supplier.blade.php
    public function create($id){

    	$pembelian = new Pembelian;
    	$pembelian->id_supplier = $id;
    	$pembelian->total_item = 0;
    	$pembelian->total_harga = 0;
    	$pembelian->diskon = 0;
    	$pembelian->bayar = 0;
    	$pembelian->save();

    	session(['id_pembelian' => $pembelian->id_pembelian]);
    	session(['id_supplier' => $id]);

    	return Redirect::route('pembelian_detail.index');
    }

}
