<!-- refactored -->

<?php

function fetchComplaint($kode, $koneksi)
{
  $stmt = $koneksi->prepare("SELECT a.id_pengaduan, a.judul, a.no_telpon, a.foto, a.status, a.keterangan, a.waktu_aduan, a.tanggapan, j.id_jenis, j.jenis, p.nama_pengadu FROM tb_pengaduan a JOIN tb_jenis j ON a.jenis = j.id_jenis JOIN tb_pengadu p ON a.author = p.id_pengadu WHERE id_pengaduan = ?");
  $stmt->bind_param('s', $kode);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

if (isset($_GET['kode'])) {
  $data_cek = fetchComplaint($_GET['kode'], $koneksi);
}

function sendMessage($token, $target, $message)
{
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
      'target' => $target,
      'message' => $message,
    ),
    CURLOPT_HTTPHEADER => array(
      "Authorization: $token"
    ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
}


?>

<!-- HTML content here -->


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

    // Send messages
    $token_wa = "kQXDoqDmuLDAN!owWbbQ";
    $no_telp = $data_cek['no_telpon'];
    $messageUser = "INFO PENGADUAN PENERANGAN JALAN UMUM

Halo $aduan !!!
Aduan anda sedang kami proses
Tunggu pemberitahuan selanjutnya dari kami

Terimakasih.";
    sendMessage($token_wa, $no_telp, $messageUser);
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

<!-- noteed ubah tanggap dan selesai pesannya masih sama  -->