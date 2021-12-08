<?php

if (isset($_GET['kode'])) {
  $sql_cek = "SELECT * FROM tb_pengadu WHERE id_pengadu='" . $_GET['kode'] . "'";
  $query_cek = mysqli_query($koneksi, $sql_cek);
  $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>


<div class="panel panel-info">
  <div class="panel-heading">
    <i class="glyphicon glyphicon-edit"></i>
    <b>Ubah Pengadu</b>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <form method="POST">

          <div class="form-group">
            <input type='hidden' class="form-control" name="id_pengadu" value="<?php echo $data_cek['id_pengadu']; ?>" readonly />
          </div>

          <div class="form-group">
            <label>Nama Pengadu</label>
            <input class="form-control" name="nama_pengadu" value="<?php echo $data_cek['nama_pengadu']; ?>" />
          </div>
          <div class="form-group">
            <label>Jenis Kelamin :</label>
            <select name="jekel" class="form-control">
              <?php
              //menhecek data yg dipilih sebelumnya
              if ($data_cek['jekel'] == "Laki-Laki") echo "<option value='Laki-Laki' selected>LK</option>";
              else echo "<option value='Laki-Laki'>Laki-Laki</option>";

              if ($data_cek['jekel'] == "Perempuan") echo "<option value='Perempuan' selected>Perempuan</option>";
              else echo "<option value='Perempuan'>Perempuan</option>";
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>No HP</label>
            <input class="form-control" name="no_hp" value="<?php echo $data_cek['no_hp']; ?>" />
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input class="form-control" name="alamat" value="<?php echo $data_cek['alamat']; ?>" />
          </div>
          <div>
            <input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
            <a href="?page=pengadu_view" title="Kembali" class="btn btn-default">Batal</a>
          </div>

      </div>
      </form>
    </div>

  </div>
</div>
</div>


<?php

if (isset($_POST['Ubah'])) {

  $sql_ubah = "UPDATE tb_pengadu SET
		nama_pengadu='" . $_POST['nama_pengadu'] . "',
		jekel='" . $_POST['jekel'] . "',
		no_hp='" . $_POST['no_hp'] . "',
		alamat='" . $_POST['alamat'] . "' 
		WHERE id_pengadu='" . $_POST['id_pengadu'] . "'";
  $query_ubah = mysqli_query($koneksi, $sql_ubah);

  $sql_ub = "UPDATE tb_pengguna SET
        nama_pengguna='" . $_POST['nama_pengadu'] . "'
        WHERE id_pengguna='" . $_POST['id_pengadu'] . "'";
  $query_pengguna = mysqli_query($koneksi, $sql_ub);

  if ($query_ubah && $query_pengguna) {
    echo "<script>
        Swal.fire({title: 'Ubah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=pengadu_view';
            }
        })</script>";
  } else {
    echo "<script>
        Swal.fire({title: 'Ubah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=pengadu_view';
            }
        })</script>";
  }
}
?>
<!-- end -->