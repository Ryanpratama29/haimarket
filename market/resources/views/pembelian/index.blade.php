@extends('layouts.app')

@section('title')
	Daftar Pembelian
@endsection

@section('breadcrumb')
	@parent
	<li>pembelian</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i>Transaksi Baru</a>

					<!-- JIKA DATANYA TIDAK KOSONG ALIAS ADA MAKA AKAN KE ARAHKAN KE DETAIL PEMBELIAN -->
					@if(!empty(session('id_pembelian')))

					<a href="{{route('pembelian_detail.index')}}" class="btn btn-info"><i class="fa fa-plus-circle"></i>Transaksi Aktif</a>

					@endif

				</div>


				<div class="box-body">
					<table id="pembelian" class="table table-striped">
						<thead>
							<tr>
								<th width="30">No</th>
								<th>Tanggal</th>
								<th>Supplier</th>
								<th>Total item</th>
								<th>Total harga</th>
								<th>Diskon</th>
								<th>Total bayar</th>
								<th width="100">Aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>


			</div>
		</div><!--penutup col-xs-12-->
	</div><!--penutup row-->

	@include('pembelian.supplier')
	@include('pembelian.detail')

@endsection

@section('script')
	<script type="text/javascript">
		var table,save_method,table1;


		$(function(){
			// tabel pembelian kita simpan dalam var table
			table = $('#pembelian').DataTable({
				"processing" : true,
				"serverSide" : true,
				"ajax" : {
					"url" : "{{route('pembelian.data')}}",
					"type" : "GET"
				},
				
			});

			//tabel 1 digunakan untuk menampilkan pembelian detail pada saat kita menekan tombol show 
			table1 = $('.tabel-detail').DataTable({
				"dom" : 'Brt',
				"bSort" : false,
				"processing" : true
			});

		//menampilkan data table supplier dari supplier.php		
			$('#supplier').DataTable();

		});

		function addForm(){
			$('#modal-supplier').modal('show');
		}

		//menampilkan tabel pembelian detail ketika user menekan tombol showDetail
		function showDetail(){
			$('#modal-detail').modal('show');
			table.ajax.url("Pembelian/"+id+"lihat");
			table.ajax.reload();
		}
	</script>
@endsection




