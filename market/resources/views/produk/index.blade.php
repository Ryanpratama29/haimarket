@extends('layouts.app')

@section('title')
	Daftar Produk
@endsection

@section('breadcrumb')
	@parent
	<li>produk</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle">Tambah</i></a>

					<a onclick="deleteAll()" class="btn btn-danger"><i class="fa fa-trash">Hapus</i></a>

					<a onclick="printBarcode()" class="btn btn-info"><i class="fa fa-barcode">Cetak Barcode</i></a>
				</div>

				<div class="box-body">
					<form method="post" id="form-produk">
						{{csrf_field()}}

						<table id="mytable" class="table table-striped">
							<thead>
							
								<tr>
									<th width="20"><input type="checkbox" value="1" id="select-all"></th>
									<th width="20">No</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Kategori</th>
									<th>Merk</th>
									<th>Harga Beli</th>
									<th>Harga Jual</th>
									<th>Diskon</th>
									<th>stok</th>
									<th width="100">Aksi</th>
								</tr>

							</thead>	
							<tbody></tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

	@include('produk.form')
@endsection

	@section('script')

		<script type="text/javascript">
			
			var table,save_method;
			$(function(){

				//menampilkan data dengan DataTable
				table = $('#mytable').DataTable({
					'processing' : true,
					'serverSide' : true,
					'type'  :"GET",
					'ajax'  : "{{route('produk.data')}}",
					'columnsDefs' :[{
						'target' :0,
						'searchable' :false,
						'orderable' : false
					}],
					'order' : [1,'asc']
				});

				//centang semua checkbox ketika checkbox dengan isi #select all di centang
				$('#select-all').click(function(){
					$('input[type="checkbox"]').prop('checked',this.checked);
				});

				//menyimpan data dari form Tambah/edit

				$('#modal-form form').validator().on('submit',function(e){
					if(!e.isDefaultPrevented()){
						var id = $('#id').val();
						//kalau methodnya add maka ia mengarahkan ke produkController untuk menyimpan
						if(save_method == "add") url = "{{route('produk.store')}}";
						//kalau menthod nya selain add maka ketika menekan tombol submit maka akan mengarahkan ke method update dengan method patch dimana method tsb kita sudah deklarasi di method editform

						//artinya kalau methodnya edit maka ia akan ke method patch 
						else url = "{{url('produk').'/'}}"+id;


						$.ajax({
							url : url,
							type : "POST",
							data :$('#modal-form form').serialize(),
							dataType : 'JSON',
							success : function(data){
								if(data.msg=='error'){
									alert('Kode produk sudah digunakan!');
									$('#kode').focus().select();
								}else{
									$('#modal-form').modal('hide');
									table.ajax.reload();
								}
							},
							error : function(){
								alert("Tidak dapat menyimpan data");
							}
						});
						return false;
					}
				});
			});


			//menampilkan form tambah data
			function addForm(){
				save_method = "add";
				$('input[name=_method]').val('POST');
				$('#modal-form').modal('show');
				$('#modal-form form')[0].reset();
				$('.modal-title').text('Tambah Produk');
				$('#kode').attr('readonly',false);
			}

			function editForm(id){
				save_method = "edit";
				$('input[name=_method]').val('PATCH');
				$('#modal-form form')[0].reset();
				$.ajax({
					url : "produk/" + id + "/edit",
					type : "GET",
					dataType : "JSON",
					success : function(data){
						$('#modal-form').modal('show');
						$('.modal-title').text('Edit Produk');
						$('#id').val(data.id_produk);
						$('#kode').val(data.kode_produk).attr('readonly',true);
						$('#nama').val(data.nama_produk);
						$('#kategori').val(data.id_kategori);
						$('#merk').val(data.merk);
						$('#harga_beli').val(data.harga_beli);
						$('#diskon').val(data.diskon);
						$('#harga_jual').val(data.harga_jual);
						$('#stok').val(data.stok);
					},
					error : function(){
						alert('Tidak dapat menampilkan data!');
					}
				});
			}


			function deleteData(id){
				var csrf_token = $('meta[name="csrf-token"]').attr('content');
				if(confirm("Apakah yakin data akan dihapus?")){
					$.ajax({
						url : "{{url('produk')}}" + '/' + id,
						type : "POST",
						data : {'_method' : 'DELETE','_token': csrf_token},
						success : function(data){
							table.ajax.reload();
						},
						error : function(){
							alert('Tidak dapat menghapus data!');
						}
					});
				}
			}

			//menghapus semua data yag dicentang
			function DeleteAll(){
				if($('input:checked').length < 1){
					alert('pilih data yng akan dihapus!');
				}else if(confirm("Apakah yakin akan menghapus semua data yang terpiih?")){
					$.ajax({
						url : "{{url('produk')}}" + '/' + 'hapus',
						type : "POST",
						data : $('#form-produk').serialize(),
						success : function(data){
							table.ajax.reload();
						},
						error : function(){
							alert("Tidak dapat menghapus data!");
						}
					});
				}
			}

			//mencetak barcode ketika tombol cetak barcode diklik
			function printBarcode(){
				if($('input:checked').length < 1){
					alert('pilih data yang akan dicetak!');
				}else{
					//nah disini jika tombol barcode ditekan maka akan mengarahkan  ke,attr action produk cetak yang berisi file produk controller (printBarcode)
					$('#form-produk').attr('target','blank').attr('action',"produk/cetak").submit();
				}
			}

		</script>

	@endsection
