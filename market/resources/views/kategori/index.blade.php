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
					<a onclick=" addForm()" class="btn btn-success"><i class="fa fa-plus-circle">Tambah</i></a>
				</div>

				<div class="box-body">
					<table id="tabelku" class="table table-striped">
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
	
	<!-- menampilkan data dengan plugin DataTable -->
	<script type="text/javascript">
		var table,save_method;
		$(function(){

		table=	$('#tabelku').DataTable({
			"processing" : true,
			"serverSide" : true,
			"type" : " GET",
			"ajax" :"{{route('kategori.data')}}"		
		});

	//menyimpan data dengan form tambah/edit beseerta validasinya
		$('#modal-form form').validator().on('submit',function(e){
			if(!e.isDefaultPrevented()){
				var id = $('#id').val();
				if(save_method == "add") url ="{{route('kategori.store')}}";
				//pada saat mekan tombol submit maka akan melakukan proses update
				else url = "{{url('kategori').'/'}}"+id;

				$.ajax({
					url : url,
					type : "POST",
					data :$('#modal-form form').serialize(),
					success : function(data){
						$('#modal-form').modal('hide');
						table.ajax.reload();
						//tambahkan sweetalert
						swal({
							title : 'Success',
							text : 'Data has been Created!',
							type :'success',
							timer : '1500'
						})

					},
					error : function(){
						// alert("tidak Dapat menyimpan data!");
						swal({
							title : 'Oops..',
							text : 'Something went wrong',
							type :'error',
							timer : '1500'
						})
					}
				});
				return false;
			}
		});

	});	

		//menampilkan form tambah data kategori

		function addForm(){
			//save_method ini digunakan menentukan url yang akan kita gunakan apakah kita mau membuat data baru atau melakukan pengeditan data
			save_method = "add";
			//kita menseleksi inputan dengan name_method dengan value post (seperti yang dibahas pada form terdapat fungsi method_field dan mengisi nya dengan value post )
			$('input[name=_method]').val('POST');
			//kita seleksi modal form dan mengubah modal agar muncul 
			$('#modal-form').modal('show');
			//kita reset setiap inputanya
			$('#modal-form form')[0].reset();
			//kita isi modal title dengan text
			$('.modal-title').text('Tambah Kategori');
		}

		//menampilkan form edit dan menampilkan data pada form tersebut

		function editForm(id){
			//jadi ketika kita mengelik tombol edit maka kita menggunakan method edit bukan add
			save_method ="edit";

			//input name=_method berfungsi untuk patch ini sudah ditentukan unutk mengupdate
			$('input[name=_method]').val('PATCH');
			$('#modal-form form')[0].reset();
			$.ajax({
				url : "kategori/" + id +"/edit",
				type : "GET",
				dataType : "JSON",
				success : function(data){
					$('#modal-form').modal('show');
					$('.modal-title').text('Edit Kategori');
					$('#id').val(data.id_kategori);
					$('#nama_kategori').val(data.nama_kategori);
				},
				error : function(){
					alert('Tidak dapat menampilkan data');
				}
			});
		}

/*
		function deleteData(id){
			var popup = confirm('Are you sure for delete this data');
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			if (popup == true){
				$.ajax({
					url : "{{url('kategori')}}" + '/' + id,
					type: "POST",
					//knp method kita masukkan disini krn tidak seperti edit dan simpan yang menggunakan form sedangkan delete tidak menggunakan form artinya ketika menekan tombol delete data tidak dikirim ke form
					data : {'_method':'DELETE','_token' : csrf_token},
					success : function(data){
						table.ajax.reload();
						console.log(data);
					},
					error : function(){
						alert('Ooops!something wrong');
					}
				})
			}
		}
*/

		function deleteData(id){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			swal({
				title : 'Are you sure?',
				text  : "You wont be able to revert this!",
				type : 'warning',
				showCancelButton : true,
				cancelButtonColor : '#d33',
				confirmButtonColor : '#3085d6',
				confirmButtonText  : 'Yes,delete it!'
			}).then(function(){
				$.ajax({
					url : "{{url('kategori')}}" + '/' + id,
					type : "POST",
					data : {'_method' : 'DELETE','_token': csrf_token},
					success : function(data){
						table.ajax.reload();
						swal({
							title : 'Success',
							text : 'Data has been Deleted',
							type : 'success',
							timer : '1500'
						})
					},
					error : function(){
						swal({
							title : 'Oops..',
							text  :'Something went wrong',
							type : 'error',
							timer : '1500'
						})
					}
				});
			});
		}	
	
	</script>


@endsection

















