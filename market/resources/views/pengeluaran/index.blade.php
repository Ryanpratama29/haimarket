@extends('layouts.app')

@section('title')
	Daftar Pengeluaran
@endsection

@section('breadcrumb')
	@parent
	<li>Pengeluaran</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i>Tambah</a>
				</div><!--penutup box header-->

				<div class="box-body">
					<table id="tabel" class="table table-striped">
						<thead>
							<tr>
								<th width="30">No</th>
								<th>Tanggal</th>
								<th>jenis Pengeluaran</th>
								<th>Nominal</th>
								<th width="100">Aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div><!--penutup box-->
		</div><!--penutup col-xs-12-->
	</div><!--penutup row-->
@endsection

@section('script')
	<script type="text/javascript">
		var table,save_method;

		$(function(){
			table = $('#tabel').DataTable({
				"processing" : true,
				"serverSide" : true,
				"type" : "GET",
				"ajax" :"{{route('pengeluaran.data')}}"
				
			})
		});

	</script>
@endsection