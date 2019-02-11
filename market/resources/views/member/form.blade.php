<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="form-horizontal" data-toggle="validator" method="post">
				{{csrf_field()}} {{method_field('POST')}}

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
					</button>

					<h3 class="modal-title"></h3>
				</div><!--penutup modal header-->

				<div class="modal-body">
					<input type="hidden" id="id" name="id">

					<div class="form-group">
						<label for="kode" class="col-md-3" control-label>Kode Member</label>

						<div class="col-md-6">
							<input id="kode" type="kode" type="number" class="form-control" name="kode" autofocus required>
							<span class="help-block with-errors"></span>
						</div>
					</div><!--penutup form-group-->

					<div class="form-group">
						<label for="nama" class="col-md-3" control-label>Nama Member</label>

						<div class="col-md-6">
							<input id="nama" type="text" class="form-control" name="nama" required>
							<span class="help-block with-errors"></span>
						</div>
					</div><!--penutup form-group-->

					<div class="form-group">
						<label for="alamat" class="col-md-3" control-label>Alamat</label>
						<div class="col-md-8">
							<input id="alamat" type="text" name="alamat" class="form-control" required>

							<span class="help-block with-errors"></span>
						</div>
					</div><!--penutup form-group-->

					<div class="form-group">
						<label for="telepon" class="col-md-3" control-label>Telepon</label>
						<div class="col-md-6">
							<input id="telepon" type="text" name="telepon" class="form-control" required>
							<span class="help-block with-errors"></span>
						</div>
					</div><!--penutup form-group-->
				</div><!--penutup modal-body-->

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i>Simpan</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>Batal</button>
				</div>

			</form>
		</div><!--penutup dialog modal content-->
	</div><!--penutup dialog modal-lg-->
	
</div>