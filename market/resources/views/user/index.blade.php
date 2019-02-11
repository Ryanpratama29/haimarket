@extends('layouts.app')

@section('title')
	Daftar User
@endsection

@section('breadcrumb')
	@parent
	<li>User</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i>Tambah</a>
				</div><!--penutup box-header-->

				<div class="box-body">
					<table id="tabelku" class="table table-striped">
						<thead>
							<tr>
								<th width="30">No</th>
								<th>Nama User</th>
								<th>Email</th>
								<th width="100">Aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div><!--penutup box bod-->
			</div><!--penutup box-->
		</div><!--penutup col-xs-12-->
	</div><!--penutup row-->
	@include('user.form')
@endsection

@section('script')
	<script type="text/javascript">
		var table,save_method;

		$(function(){
			table = $('#tabelku').DataTable({
				"processing" : true,
				"serverSide" : true,
				"type" : "GET",
				"ajax" : "{{route('user.data')}}",
			});

			$('#modal-form form').validator().on('submit',function(e){
				if(!e.isDefaultPrevented()){
					var id = $('#id').val();
					if(save_method == "add") url ="{{route('user.store')}}";
					else url = "{{url('user').'/'}}"+id;

					$.ajax({
						url : url ,
						type : "POST",
						data : $('#modal-form form').serialize(),
						success : function(data){
							$('#modal-form').modal('hide');
							table.ajax.reload();
						},
						error : function(){
							alert('Tidak Dapat Menyimpan Data!');
						}
					});
					return false;

				}
			});
		});

		function addForm(){
			save_method = "add";
			$('input[name=_method]').val("POST");
			$('#modal-form').modal('show');
			$('#modal-form form')[0].reset();
			$('.modal-title').text('Tambah User');
			$('#password, #password1').attr('required',true);
		}

		function editForm(id){
			save_method = "edit";
			$('input[name=_method]').val('PATCH');
			$('#modal-form form')[0].reset();
			$.ajax({
				url : "user/"+id+"/edit",
				type : "GET",
				dataType : "JSON",
				success : function(data){
					$('#modal-form').modal('show');
					$('.modal-title').text('Edit User');
					$('#id').val(data.id);
					$('#nama').val(data.name);
					$('#email').val(data.email);
					$('#password,#password1').removeAttr('required');
				},
				error : function(){
					alert("Tidak Dapat menampilkan Data!");
				}
			});
		}

		function deleteData(id){
			if(confirm("Apakah yakin data akan dihapus?")){
				$.ajax({
					url : "user/" + id,
					type : "POST",
					data : {'_method' : 'DELETE','_token' : $('meta[name=csrf-token]').attr('content')},
					success : function(data){
						table.ajax.reload();
					},
					error : function(){
						alert('Tidak dapat menghapus data');
					}

				});
			}
		}

	</script>
@endsection

