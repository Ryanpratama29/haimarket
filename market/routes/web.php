<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tanggal',function(){
	echo tanggal_indonesia(date('Y-m-d'));
});

Route::get('uang',function(){
	echo "Rp.".format_uang(12500000);
});

Route::get('terbilang',function(){
	echo ucwords(terbilang(12578600));
});


//route untuk management kategori

Route::group(['middleware'=>['web','cekuser:1']],
	function(){
		Route::get('kategori/data','KategoriController@listData')->name('kategori.data');
		Route::resource('kategori','KategoriController');

	}
);

//Route untuk management produk
Route::group(['middleware' => ['web','cekuser:1']],function(){
	Route::get('produk/data','ProdukController@listData')->name('produk.data');
	//route untuk menghapus data yang terpilih
	Route::post('produk/hapus','ProdukController@deleteSelected');
	//route untuk mencetak password
	Route::post('produk/cetak','ProdukController@printBarcode');
	Route::resource('produk','ProdukController');
});


// Route::get('/admin',function(){
// 	return view('auth/login');
// });


Route::group(['middleware' => ['web','cekuser:1']], function(){
	Route::get('supplier/data','SupplierController@listData')->name('supplier.data');
	Route::resource('supplier','SupplierController');
});

Route::group(['middleware' => ['web','cekuser:1']],function(){
	Route::get('member/data','MemberController@listData')->name('member.data');
	Route::post('member/cetak','MemberController@printCard');
	Route::resource('member','MemberController');
});

// Route::group(['middleware' => ['web','cekuser:1']],function(){
// 	Route::get('pengeluaran/data','PengeluaranController@listData')->name('pengeluaran.data');
// 	Route::resource('pengeluaran','PengeluaranController');
// });


Route::group(['middleware'=>['web','cekuser:1']],function(){
	Route::get('user/data','UserController@listData')->name('user.data');
	Route::resource('user','UserController');
});


Route::group(['middleware'=>'web'],function(){
	Route::get('user/profil','UserController@profil')->name('user.profil');
	Route::patch('user/{id}/change','UserController@changeProfil');
});


Route::group(['middleware'=>['web','cekuser:1']],function(){
	Route::get('pembelian/data','PembelianController@listData')->name('pembelian.data');
	Route::get('pembelian/{id}/tambah','PembelianController@create');
	Route::get('pembelian/{id}/lihat','PembelianController@show');
	Route::resource('pembelian','PembelianController');
});

//@create digunakan unutk menyimpan data pembelian_baru tetapi hanya mengisi suppliernya saja yang lain sementara diisi dengan 0 dan akan diupdate ketika menyimpan data transaksi pada method store

//sedangkan @store digunakan untuk update stok produk dengan ditambah jumlah item pada transkaki baru

Route::group(['middleware'=>['web','cekuser:1']],function(){
	Route::get('pembelian_detail/{id}/data','PembelianDetailController@listData')->name('pembelian_detail.data');
	Route::get('pembelian_detail/loadform/{diskon}/{total}','PembelianDetailController@loadForm');
	Route::resource('pembelian_detail','PembelianDetailController');
});

//loadForm digunakan untuk menampilkan hasil perhitungan total dan diskon yang sudah dikonversi ke formar uang beserta angka terbilang menggunakan ajax


