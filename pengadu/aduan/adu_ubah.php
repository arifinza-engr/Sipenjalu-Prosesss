<?php

if (isset($_GET['kode'])) {
  $sql_cek = "select a.id_pengaduan, a.judul,a.no_telpon, a.foto, a.status,a.alamat, a.keterangan, j.id_jenis, j.jenis 
		from tb_pengaduan a join tb_jenis j on a.jenis=j.id_jenis where id_pengaduan='" . $_GET['kode'] . "'";
  $query_cek = mysqli_query($koneksi, $sql_cek);
  $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>


<div class="panel panel-info">
  <div class="panel-heading">
    <i class="glyphicon glyphicon-edit"></i>
    <b>Ubah Pengaduan</b>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <input type='hidden' class="form-control" name="id_pengaduan" value="<?php echo $data_cek['id_pengaduan']; ?>" readonly />
          </div>

          <div class="form-group">
            <label>Nama</label>
            <input class="form-control" name="judul" value="<?php echo $data_cek['judul']; ?>" />
          </div>
          <div class="form-group">
            <label>No Hp/Whatsapp</label>
            <input class="form-control" name="no_telpon" value="<?php echo $data_cek['no_telpon']; ?>" />
          </div>
          <hr>
          <div class="form-group">
            <label>Jenis Aduan</label>
            <select name="jenis" class="form-control">
              <?php
              // ambil data dari database
              $query = "select * from tb_jenis";
              $hasil = mysqli_query($koneksi, $query);
              while ($row = mysqli_fetch_array($hasil)) {
              ?>
                <option value="<?php echo $row['id_jenis'] ?>" <?= $data_cek['id_jenis'] == $row['id_jenis'] ? "selected" : null ?>>
                  <?php echo $row['jenis'] ?>
                </option>
              <?php
              }
              ?>
            </select>
          </div>


          <div class="form-group">
            <label>Alamat Aduan</label>
            <input class="form-control" name="alamat" value="<?php echo $data_cek['alamat']; ?>" />
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan" rows="5" required><?php echo $data_cek['keterangan']; ?></textarea>
          </div>

          <div class="form-group">
            <label>Foto Lama</label>
            <br>
            <img src="foto/<?php echo $data_cek['foto']; ?>" width="80px" />
            <br>
            <br>
            <input type="file" name="foto" />
          </div>

          <div>
            <input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
            <a href="?page=aduan_view" title="Kembali" class="btn btn-default">Batal</a>
          </div>

      </div>
      </form>
    </div>

  </div>
</div>
</div>

<?php

$sumber = @$_FILES['foto']['tmp_name'];
$target = 'foto/';
$nama_file = @$_FILES['foto']['name'];
$pindah = move_uploaded_file($sumber, $target . $nama_file);

if (isset($_POST['Ubah'])) {

  if (!empty($sumber)) {
    $foto = $data_cek['foto'];
    if (file_exists("foto/$foto")) {
      unlink("foto/$foto");
    }

    $sql_ubah = "UPDATE tb_pengaduan SET
      judul='" . $_POST['judul'] . "',
      no_telpon='" . $_POST['no_telpon'] . "',
			jenis='" . $_POST['jenis'] . "',
      foto='" . $nama_file . "',
      alamat='" . $_POST['alamat'] . "',
			keterangan='" . $_POST['keterangan'] . "'
            WHERE id_pengaduan='" . $_POST['id_pengaduan'] . "'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
  } elseif (empty($sumber)) {
    $sql_ubah = "UPDATE tb_pengaduan SET
			judul='" . $_POST['judul'] . "',
      no_telpon='" . $_POST['no_telpon'] . "',
			jenis='" . $_POST['jenis'] . "',
      alamat='" . $_POST['alamat'] . "',
			keterangan='" . $_POST['keterangan'] . "'
            WHERE id_pengaduan='" . $_POST['id_pengaduan'] . "'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
  }

  if ($query_ubah) {
    echo "<script>
        Swal.fire({title: 'Ubah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=aduan_view';
            }
        })</script>";
  } else {
    echo "<script>
        Swal.fire({title: 'Ubah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=aduan_view';
            }
        })</script>";
  }
}
?>

<!-- end -->