<?php include "inc/koneksi.php";

function generate_uuid()
{
  return sprintf(
    '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0x0fff) | 0x4000,
    mt_rand(0, 0x3fff) | 0x8000,
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff)
  );
}

$UUID = generate_uuid();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Siprutlah</title>

  <link rel="stylesheet" href="assets/css/signup.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body>
  <section class="vh-100 bg-image">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 10px;">
              <div class="card-body p-3">
                <h2 class="text-uppercase text-center mb-4">Daftar Akun</h2>

                <form method="POST">
                  <div class="form-outline mb-2">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama_pengadu" class="form-control form-control-sm" placeholder="Masukan Nama Anda" required />
                  </div>
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Jenis kelamin</label>
                    <select class="form-select" id="inputGroupSelect01" name="jekel">
                      <option selected>Pilih...</option>
                      <option value="1">Laki-Laki</option>
                      <option value="2">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-outline mb-2">
                    <label class="form-label">No Telepon</label>
                    <input type="tel" name="no_hp" class="form-control form-control-sm" placeholder="Masukan No Telepon" required />
                  </div>
                  <div class="form-outline mb-2">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control form-control-sm" placeholder="Masukan Alamat Rumah" required />
                  </div>
                  <div class="form-outline mb-2">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control form-control-sm" placeholder="Masukan Username" required />
                  </div>
                  <div class="form-outline mb-2">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm" id="psw" placeholder="Masukan Password" required />
                  </div>
                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="" onclick="showPassword()">
                    <label class="form-check-label fst-italic"><small>
                        *Show Password
                      </small>
                    </label>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" name="Simpan" value="Simpan" class="btn btn-primary">Daftar</button>
                  </div>
                  <p class="text-center text-muted mt-4 mb-0"><a href="login"><u>Sudah Punya Akun? Silahkan Login</u></a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php

  if (isset($_POST['Simpan'])) {

    $sql_simpan = "INSERT INTO tb_pengadu (id_pengadu, nama_pengadu, jekel, no_hp, alamat) VALUES (
			'$UUID',
			'" . $_POST['nama_pengadu'] . "',
			'" . $_POST['jekel'] . "',
			'" . $_POST['no_hp'] . "',
			'" . $_POST['alamat'] . "')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    $sql_pengguna = "INSERT INTO tb_pengguna (id_pengguna, nama_pengguna, username, password) VALUES (
			'$UUID',
			'" . $_POST['nama_pengadu'] . "',
			'" . $_POST['username'] . "',
			'" . $_POST['password'] . "')";
    $query_pengguna = mysqli_query($koneksi, $sql_pengguna);

    if ($query_simpan && $query_pengguna) {
      echo "<script>
            Swal.fire({title: 'Daftar Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'login';
                }
            })</script>";
    } else {
      echo "<script>
            Swal.fire({title: 'Daftar Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'signup';
                }
            })</script>";
    }
  }
  ?>
  <!-- end -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>
  <!-- JQUERY SCRIPTS -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- CUSTOM SCRIPTS -->

  <script src="assets/js/dataTables/jquery.dataTables.js"></script>
  <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
  <script>
    $(document).ready(function() {
      $('#dataTables-example').dataTable();
    });
  </script>

  <script>
    function showPassword() {
      var x = document.getElementById("psw");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

</body>

</html>