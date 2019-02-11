@extends('layouts.app')

@section('title')
	
	Daftar Kategori
	
@endsection

@section('breadcrumb')
	@parent
	<li>Kategori</li>
@endsection

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle">Tambah</i></a>
				</div>

				<div class="box-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="30">No</th>
								<th>Nama Kategori</th>
								<th width="100">Aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>	
				</div><!--penutup box body -->
			</div><!--penutup box-->
		</div><!--penutup col-xs-12 -->
	</div><!--penutup row -->

@include('kategori.form')

@endsection

@section('script')
	
	<script type="text/javascript">
		
		var table,save_method;

		$(function(){
			//menampilkan data dengan dengan plugin DataTable
			table = $('.table').DataTable({
				"processing": true,
				"ajax" :{
					"url" :"{{route('kategori.data')}}",
					"type":"GET"
				}
			});

			// //menyimpan data form tambah/edit beserta validasinya
			// 	$('modal-form form').validator().on('submit',function(e){
			// 		if(!e.isDefaultPrevented()){
			// 			var id = $('#id').val();
			// 			if(save_method == "add") url = "{{route(kategori.store)}}";
			// 			else url = "kategori/" + id;

			// 			$.ajax({
			// 				url : url,
			// 				type: "POST",
			// 				data : $(#modal-form form).serialize(),
			// 				success : function(data){
			// 					$('#modal-form').modal('hide');
			// 					table.ajax.reload();
			// 				},
			// 				error : function(){
			// 					alert('Tidak dapat menyimpan data!');
			// 				}
			// 			});
			// 			return false;
			// 		}
			// 	});
		});

	</script>


@endsection

















