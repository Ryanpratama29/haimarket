<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use Yajra\DataTables\Datatables;


class PengeluaranController extends Controller
{

	public function index(){
		return view('pengeluaran.index');
	}

	public function listData(){
		$pengeluaran = Pengeluaran::orderBy('id_pengeluaran','desc')->get();
		$no = 0;
		$data = array();
		foreach($pengeluaran as $list){
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->tanggal_indonesia(substr($list->created_at,0,10),false);
			$row[] = $list->jenis_pengeluaran;
			$row[] = "Rp.".format_uang($list->nominal);
			$row[] = '<div class="btn-group">

						<a onclick="editForm('.$list->id_pengeluaran.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

						<a onclick="deleteData('.$list->id_pengeluaran.')" class="fa fa-danger btn-sm"><i class="fa fa-trash"></i></a>
					 </div>';
					 $data[] = $row;
		}
		return Datatables::of($data)->escapeColumns([])->make(true);
	}
}
