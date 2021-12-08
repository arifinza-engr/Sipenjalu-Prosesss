<?php

if (isset($_GET['kode'])) {
	$sql_cek = "select a.id_pengaduan, a.judul,a.no_telpon, a.foto, a.status, a.keterangan, a.waktu_aduan, a.tanggapan, j.id_jenis, j.jenis, p.nama_pengadu
		from tb_pengaduan a join tb_jenis j on a.jenis=j.id_jenis join tb_pengadu p on a.author=p.id_pengadu where id_pengaduan='" . $_GET['kode'] . "'";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-edit"></i>
		<b>Tanggapi Pengaduan
		</b>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped">

				<tbody>
					<tr>
						<td rowspan="5">
							<center>
								<img src="foto/<?php echo $data_cek['foto']; ?>" width="250px" />
							</center>
						</td>
						<td>Nama Pengadu</td>
						<td width="55%">:
							<?php echo $data_cek['judul']; ?>
						</td>
					</tr>
					<tr>
						<td>Jenis</td>
						<td>:
							<?php echo $data_cek['jenis']; ?>
						</td>
					</tr>
					<tr>
						<td>Waktu Aduan</td>
						<td>:
							<?php $tgl = $data_cek['waktu_aduan'];
							echo date("d - F - Y", strtotime($tgl)) ?>
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:
							<?php echo $data_cek['status']; ?>
						</td>
					</tr>
					<tr>
						<td>No Hp</td>
						<td>:
							<?php echo $data_cek['no_telpon']; ?>
						</td>
					</tr>

				</tbody>

			</table>


			<form method="POST" enctype="multipart/form-data">

				<div class="form-group">
					<input type='hidden' class="form-control" name="id_pengaduan" value="<?php echo $data_cek['id_pengaduan']; ?>" readonly />
				</div>

				<div class="form-group">
					<label>Keterangan</label>
					<textarea class="form-control" name="" rows="2" readonly><?php echo $data_cek['keterangan']; ?></textarea>
				</div>

				<div class="form-group">
					<label class="input-group-text">Status :</label>
					<select name="status" class="form-control" required>
						<option value="">- Pilih -</option>
						<option>Tanggapi</option>
						<option>Selesai</option>
					</select>
				</div>

				<div class="form-group">
					<label>Tanggapan</label>
					<textarea class="form-control" name="tanggapan" rows="5" required><?php echo $data_cek['tanggapan']; ?></textarea>
				</div>

				<div>
					<input type="submit" name="Ubah" value="Simpan" class="btn btn-primary">

				</div>

		</div>
		</form>
	</div>

</div>

<?php

if (isset($_POST['Ubah'])) {

	$sql_ubah = "UPDATE tb_pengaduan SET
		status='" . $_POST['status'] . "',
		tanggapan='" . $_POST['tanggapan'] . "'
		WHERE id_pengaduan='" . $_POST['id_pengaduan'] . "'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);

	if ($query_ubah) {
		echo "<script>
        Swal.fire({title: 'Kelola Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=aduan_admin';
            }
        })</script>";
	} else {
		echo "<script>
        Swal.fire({title: 'Kelola Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=aduan_admin';
            }
        })</script>";
	}
}
?>

<!-- end -->