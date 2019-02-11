<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Pembelian;
use App\Supplier;
use App\Produk;
use App\PembelianDetail;

class PembelianDetailController extends Controller
{

	public function index(){
		$produk = Produk::all();
		$idpembelian = session('id_pembelian');
		$supplier  = Supplier::find(session('id_supplier'));
		return view('pembelian_detail.index',compact('produk','idpembelian','supplier'));
	}

	public function listData($id){
		$detail = PembelianDetail::leftJoin('produk','produk.kode_produk','=','pembelian_detail.kode_produk')
			->where('id_pembelian','=',$id)
			->get();

			$no = 0;
			$data = array();
			$total = 0;
			$total_item = 0;
			foreach($detail as $list){
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $list->kode_produk;
				$row[] = $list->nama_produk;
				$row[] = "Rp.".format_uang($list->harga_beli);
				$row[] = "<input type='number' class='form-control' name='jumlah $list->id_pembelian_detail' value='$list->jumlah' onChange='changeCount($list->id_pembelian_detail)'>";
				$row[] = "Rp".format_uang($list->harga_beli * $list->jumlah);
				$row[] = '<a onclick="deleteItem('.$list->id_pembelian_detail.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

				$data[] = $row;
				$total += $list->harga_beli * $list->jumlah;
				$total_item += $list->jumlah;
			}

				$data[] = array("<span class='hidetotal'>$total</span><span class='hidetotalitem'>$total_item</span>","","","","","","");

				$output = array("data"=> $data);
				return response()->json($output);
	}

	//
	public function store(Request $request){
		$produk = Produk::where('kode_produk','=',$request['kode'])->first();
		$detail = new PembelianDetail;
		$detail->id_pembelian = $request['idpembelian'];
		$detail->kode_produk = $request['kode'];
		$detail->harga_beli = $produk->harga_beli;
		$detail->jumlah = 1;
		$detail->sub_total = $produk->harga_beli;
		$detail->save();
	}

}
