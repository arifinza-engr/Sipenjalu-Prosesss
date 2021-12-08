<?php
include "inc/koneksi.php";
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin Sipenjalu</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="dist/swal/sweetalert2.min.css">
  <style>
    .swal2-popup {
      font-size: 1.6rem !important;
    }
  </style>

</head>

<body class="login">
  <div class="container">
    <div class="row ">
      <br>
      <br>
      <br>
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-primary login-shadow">
          <div class="panel-body">
            <img src="assets/img/tittle.png" class="user-image img-responsive" />
            <center>
              <h2>
                <b>SI PENJALU</b>
              </h2>
            </center>
            <CENTER>Sistem Informasi Pengaduan Penerangan Jalan Umum</CENTER>
            <form action="" method="POST" enctype="multipart/form-data">
              <br />
              <div class="form-group input-group">
                <span class="input-group-addon">
                  <i class="fa fa-tag"></i>
                </span>
                <input type="text" class="form-control" value="" placeholder="username" name="username" id="username" />
              </div>
              <div class="form-group input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" class="form-control" value="" placeholder="password" name="password" id="password" />
              </div>

              <button type="submit" class="btn btn-primary form-control" name="btnLogin" title="Masuk Sistem" id="clicker" />MASUK</button>
              <br>
              <br>
              <!-- <CENTER>Belum Punya Akun? <a href="signup">Sign Up</a></CENTER> -->
              <CENTER>SI PENJALU 2021</CENTER>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <script>
    var userValue = document.getElementById("username").value;
    var passValue = document.getElementById("password").value;

    if (userValue == "pengadu" && passValue == "123") {
      var button = document.getElementById("clicker");
      setInterval(
        function() {
          button.click()
        }, 1000
      )
    }
  </script> -->

  <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
  <!-- JQUERY SCRIPTS -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>
  <!-- SWAL -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>

</html>

<?php
if (isset($_POST['btnLogin'])) {
  $sql_login = "SELECT * FROM tb_pengguna WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";
  $query_login = mysqli_query($koneksi, $sql_login);
  $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
  $jumlah_login = mysqli_num_rows($query_login);


  if ($jumlah_login == 1) {
    session_start();
    $_SESSION["ses_id"] = $data_login["id_pengguna"];
    $_SESSION["ses_nama"] = $data_login["nama_pengguna"];
    $_SESSION["ses_level"] = $data_login["level"];
    $_SESSION["ses_grup"] = $data_login["grup"];

    echo "<script>
                    Swal.fire({title: 'SUKSES',text: '',icon: 'success',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index';
                        }
                    })</script>";
  } else {
    echo "<script>
                    Swal.fire({title: 'GAGAL',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'loginAdmin';
                        }
                    })</script>";
  }
}
?>

<!-- END -->