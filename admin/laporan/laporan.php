<?php $author=$data_id ?>
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-print"></i>
		<b>Kelola Laporan</b>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST" action="" enctype="multipart/form-data">

					<div class="form-group">
						<label>Jenis Aduan</label>
						<select name="jenis" class="form-control">
							<option value="">- Pilih -</option>
							<?php
							// ambil data dari database
							$query = "select * from tb_jenis";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
							?>
							<option value="<?php echo $row['id_jenis'] ?>">
								<?php echo $row['jenis'];  ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Tgl Awal</label>
						<input type="date" class="form-control" name="tgl_1" required/>
					</div>

					<div class="form-group">
						<label>Tgl Akhir</label>
						<input type="date" class="form-control" name="tgl_2" required/>
					</div>


					<div>
						<input type="submit" name="Cetak" value="Cetak" class="btn btn-primary">
						<a href="#" title="Kembali" class="btn btn-success">Cetak Semua</a>
					</div>
			</div>
			</form>
		</div>
	</div>
</div>