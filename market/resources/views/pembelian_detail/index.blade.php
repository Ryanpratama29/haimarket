@extends('layouts.app')

@section('title')
	Transaksi Pembelian
@endsection

@section('breadcrumb')
	@parent 
	<li>pembelian</li>
	<li>tambah</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<!-- digunakan untuk menampilkan info mengenai supplier -->
					<table>
						<tr>
							<td width="150">Supplier</td>
							<td><b>{{$supplier->nama}}</b></td>
						</tr>

						<tr>
							<td>Alamat</td>
							<td><b>{{$supplier->alamat}}</b></td>
						</tr>

						<tr>
							<td>Telepon</td>
							<td><b>{{$supplier->telepon}}</b></td>
						</tr>

					</table>
					<hr>


					<!-- FORM PRODUK MEMUAT DATA PRODUK YANG AKAN DIBELI OLEH TUAN TOKO -->

					<form class="form form-horizontal form-produk" method="post">
						{{csrf_field()}}

						<input type="hidden" name="idpembelian" value="{{$idpembelian}}">

						<div class="form-group">
							<label for="kode" class="col-md-3 control-label">Kode Produk</label>

							<div class="col-md-5">
								<div class="input-group">
									<input id="kode" type="text" class="form-control" name="kode" autofocus required>
									<span class="input-group-btn">
										<button onclick="showProduct()" type="button" class="btn btn-info">Cari</button>
									</span>		
								</div>
							</div>
						</div>
					</form>

					<!-- FORM KERANJANG BELANJA YANG TERDIRI DARI ITEM/BARANG YANG AKAN DI BELI DARI SUPPLIER-->

					<form class="form-keranjang">
						{{csrf_field()}} {{method_field('PATCH')}}
						<table class="table table-striped tabel-pembelian">
							<thead>
								<tr>
									<th width="30">No</th>
									<th>Kode Produku</th>
									<th>Nama Produk</th>
									<th align="right">Harga</th>
									<th>Jumlah</th>
									<th align="right">Sub Total</th>
									<th width="100">Aksi</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</form>

					<div class="col-md-8">
						<div id="tampil-bayar" style=
						"background: #dd4b39;
						color: #fff;
						font-size: 80px;
						text-align: center;
						height: 100px">		
						</div>

						<div id="tampil_terbilang" style=
						"background: #3c8dbc;
						color: #fff;
						font-weight: bold;
						padding: 10px">
							
						</div>




						<div class="col-md-4">
							<form class="form form-horizontal form-pembelian" method="post" action="{{route('pembelian.store')}}">
								{{csrf_field()}}

								<!-- kita buat beberapa hidden input yang digunakan untuk menyimpan data asli sebelum di konversi ke format uang data ini akan dikirim oleh form  -->
								<input type="hidden" name="id_pembelian" value="{{$idpembelian}}">
								<input type="hidden" name="total" id="total">
								<input type="hidden" name="totalitem" id="totalitem">
								<input type="hidden" name="bayar" id="bayar">

								<div class="form-group">
									<label for="totalrp" class="col-md-4 control-label">Total</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="totalrp" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="diskon" class="col-md-4 control-label">Diskon</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="diskon" name="diskon" value="0">
									</div>
								</div>

								
								<div class="form-group">
									<label for="bayarrp" class="col-md-4 control-label">Bayar</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="bayarrp" readonly>
									</div>
								</div>
							</form>	
						</div>
					</div>

							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-rightsimpan"><i class="fa fa-floppy-o">Simpan Transaksi</i></button>
							</div>
					

				</div><!--penutup box-body-->
			</div><!--penutup box-->
		</div><!--penutup col-xs-12-->
	</div><!--penutup row-->
	@include('pembelian_detail.produk')
@endsection

@section('script')
	<script type="text/javascript">
		var table;

		$(function(){
			//menampilkan data produk pada modal produk
			$('.table-produk').DataTable();

			//pada saat sudah menambahkan item/produk maka kita tampilkan produk yang kita pilih pada tabel pembelian atau form keranjang

			table = $('.tabel-pembelian').DataTable({
				"dom" : 'Brt',
				"bSort" : false,
				"Processing" : true,
				"serverSide" : true,
				"ajax": {
					"url" : "{{route('pembelian_detail.data','$idpembelian')}}",
					"type" : "GET"
				}
			}).on('draw.dt',function(){
				loadForm($('#diskon'));
			});
		});

		//berfungsi untuk menambahkan item produk dengan method store
		function addItem(){
			$.ajax({
				url : "{{route('pembelian_detail.store')}}",
				type : "POST",
				//mengambil data dari form produk
				data : $('.form-produk').serialize(),
				success : function(data){
					$('#kode').val('').focus();
					table.ajax.reload(function(){
						loadForm($('#diskon').val());
					});
				},
				error : function(){
					alert('Tidak Dapat Menyimpan Data');
				}
			});
		}

		//menangani produk yang akan dipilih dan menjakan fungsi add item untuk menambahkan item('produk yang akan dipilihs')

		//nah disini pada saat kita memeilih produk maka produk.blade.php akan mengirimkan kode_produk yang dipilih  dan ditangkap oleh selectItem(kode) yang berisi kode item yang dipoilih.

		//kode berisi id_produk yang dipilh oleh tuan toko
		function selectItem(kode){
			//nah #kode diambil dari id dari form produk yang nantinya akan diisi dengan kode produk yang diisi/dipilih oleh toko
			$('#kode').val('kode');
			$('#modal-produk').modal('hide');
			addItem();
		}


	//digunakan untuk menampilkam modal produk
		function showProduct(){
			$('#modal-produk').modal('show');
		}



		function loadForm(diskon=0){
			$('#total').val($('.total').text());
			$('#totalitem').val($('.totalitem').text());

			$.ajax({
				url : "pembelian_detail/loadform/"+diskon+"/"+$('.total').text(),
				type : "GET",
				dataType : 'JSON',
				success : function(data){
					$('#totalrp').val("Rp."+data.totalrp);
					$('#bayarrp').val("Rp"+data.bayarrp);
					$('#bayar').val(data.bayar);
					$('#tampil-bayar').text("Rp." + data.bayarrp);
					$('#tampil-terbilang').text(data.terbilang);
				},
				error:function(){
					alert('Tidak dapat menampilkan data!');
				}
			});
		}


	</script>
@endsection




