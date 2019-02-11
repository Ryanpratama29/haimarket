@extends(layouts.app)

@section('title')
	Edit Profil
@endsection

@section('breadcrumb')
	@parent
	<li>User</li>
	<li>Edit profil</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<form class="form form-horizontal" data-toggle="validator" method="post" enctype="multipart/form-data">
					{{csrf_field()}} {{method_field("PATCH")}}

					<div class="box-body">
						<div class="alert alert-info alert-dismissible" style="display: none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

							<i class="icon fa fa-check"></i>
							perubahan berhasil disimpan
						</div><!--penutup alert-->

						<div class="form-group">
							<label for="foto" class="col-md-2 control-label">Foto Profil</label>

							<div class="col-md-4">
								<input id="foto" type="file" class="form-control" name="foto">
							</div><br>

							<div class="tampil_foto">
								<img src="{{asset('public/images/.Auth::user()->foto')}}" width="200">
							</div>
						</div>


						<div class="form-group">
							<label for="passwordlama" class="col-md-2 control-label">Password Lama</label>

							<div class="col-md-6">
								<input id="passwordlama" type="password" class="form-control" name="passwordlama">
								<span class="help-block with-errors"></span>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-md-2 control-label">Password</label>
							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password">
								<span class="help-block width"></span>
							</div>
						</div>

						<div class="form-group">
							<label for="password1" class="col-md-2 control-label">Ulang Password</label>
							<div class="col-md-6">
								<input id="password1" type="password" class="form-control" data-match="#password" name="password1">
								<span class="help-block with-errors"></span>
							</div>
						</div>

						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>Simpan Perubahan</button>
						</div>

					</div><!--penutup box-body-->

				</form>
			</div><!--penutup box-->
		</div><!--penutup col-xs-120-->
	</div><!--penutup row-->
@endsection