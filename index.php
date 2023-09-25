<?php

session_set_cookie_params(0, '/', '', false, true);
session_start();

if (empty($_SESSION['ses_nama'])) {
  header("location: login");
  exit();
} else {
  $data_id = $_SESSION["ses_id"];
  $data_nama = $_SESSION["ses_nama"];
  $data_level = $_SESSION["ses_level"];
  $data_grup = $_SESSION["ses_grup"];
}

include "inc/koneksi.php";

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SI PENJALU</title>
  <link rel="icon" href="assets/img/tittle.png" type="image/icon type">
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkyPyVxHBaWGGsJgiQDe0ttKfhE1zzDZ0&callback=initMap" async defer></script>
  <link rel="stylesheet" href="dist/css/select2.min.css" />
  <!-- Bootstrap 3 JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <style>
    .swal2-popup {
      font-size: 1.6rem !important;
    }
  </style>

</head>

<body>
  <div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand">
          <i class="glyphicon glyphicon-send"></i> SI PENJALU</a>
      </div>
      <div class="namalevel">
        <?= $data_nama; ?>
        (<?= $data_level; ?>)
      </div>

      <!-- kondisi tombol logout -->
      <?php if ($data_level == "Administrator" || $data_level == "Petugas") { ?>
        <div style="float : right;">
          <button onclick="confirmLogout()" class="btn btn-danger square-btn-adjust">LOGOUT</button>
        </div>
      <?php
      }
      ?>
      <!-- akhir kondisi -->
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
          <li class="text-center">
            <img src="assets/img/tittle.png" class="user-image img-responsive" width="40%" />
          </li>

          <!-- Level  -->
          <?php
          if ($data_level == "Administrator") {
          ?>

            <li>
              <a href="?page=admin-def">
                <i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-file fa-2x"></i> Master Data
                <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="?page=pengadu_view">Data Pengadu</a>
                </li>
                <li>
                  <a href="?page=jenis_view">Jenis Pengaduan</a>
                </li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-bell fa-2x"></i> Pengaduan
                <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="?page=aduan_admin_semua">Semua Aduan</a>
                </li>
                <li>
                  <a href="?page=aduan_admin">Menunggu</a>
                </li>
                <li>
                  <a href="?page=aduan_admin_tanggap">Ditanggapi</a>
                </li>
                <li>
                  <a href="?page=aduan_admin_selesai">Selesai</a>
                </li>
              </ul>
            </li>

            <!-- <li>
              <a href="?page=laporan">
                <i class="fa fa-comments-o fa-2x"></i> Telegram</a>
            </li> -->

            <li>
              <a href="?page=user_data">
                <i class="fa fa-user fa-2x"></i> Pengguna</a>
            </li>

            </li>

          <?php
          } elseif ($data_level == "Petugas") {
          ?>
            <li>
              <a href="?page=petugas-def">
                <i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-bell fa-2x"></i> Pengaduan
                <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="?page=aduan_admin">Menunggu</a>
                </li>
                <li>
                  <a href="?page=aduan_admin_tanggap">Ditanggapi</a>
                </li>
                <li>
                  <a href="?page=aduan_admin_selesai">Selesai</a>
                </li>
              </ul>
            </li>
          <?php
          } elseif ($data_level == "Pengadu") {
          ?>

            <li>
              <a href="?page=pengadu">
                <i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
            </li>


            <li>
              <a href="?page=aduan_view">
                <i class="fa fa-bell fa-2x"></i> Pengaduan
              </a>
            </li>

        </ul>

      <?php
          }
      ?>
      </div>
    </nav>
    <!-- /. PAGE WRAPPER  -->
    <div id="page-wrapper">
      <div id="page-inner">
        <div class="row">
          <div class="col-md-12">
            <style>
              #marquee {
                margin-top: -8px;
                text-align: center;
              }
            </style>
            <h4 id="marquee">
              <b> SISTEM INFORMASI PENGADUAN PENERANGAN JALAN UMUM BERBASIS WEBSITE </b>
              <p style="margin-top: -10px;">MENGGUNAKAN REALTIME NOTIFIKASI TELEGRAM</p>
            </h4>
            <!-- Menjadikan page web dinamis, 
                dengan menjadikan page lain yang dipanggil sebagai sebuah konten dari index.php-->
            <?php

            // Define an associative array to map page requests to file paths.
            $pageMap = [
              'admin-def' => 'default/admin.php',
              'petugas-def' => 'default/tugas.php',
              'pengadu' => 'default/pengadu.php',
              'user_data' => 'admin/pengguna/pengguna_tampil.php',
              'pengguna_tambah' => 'admin/pengguna/pengguna_tambah.php',
              'pengguna_ubah' => 'admin/pengguna/pengguna_ubah.php',
              'pedu_ubah' => 'admin/pengguna/pedu_ubah.php',
              'pengguna_hapus' => 'admin/pengguna/pengguna_hapus.php',
              'jenis_view' => 'admin/jenis/jenis_tampil.php',
              'jenis_tambah' => 'admin/jenis/jenis_tambah.php',
              'jenis_ubah' => 'admin/jenis/jenis_ubah.php',
              'jenis_hapus' => 'admin/jenis/jenis_hapus.php',
              'pengadu_view' => 'admin/pengadu/pengadu_tampil.php',
              'pengadu_tambah' => 'admin/pengadu/pengadu_tambah.php',
              'pengadu_ubah' => 'admin/pengadu/pengadu_ubah.php',
              'pengadu_hapus' => 'admin/pengadu/pengadu_hapus.php',
              'aduan_admin' => 'admin/aduan/adu_tampil.php',
              'aduan_admin_semua' => 'admin/aduan/adu_tampil_semua.php',
              'aduan_admin_tanggap' => 'admin/aduan/adu_tanggap.php',
              'aduan_admin_selesai' => 'admin/aduan/adu_selesai.php',
              'aduan_kelola' => 'admin/aduan/adu_ubah.php',
              'telegram' => 'admin/telegram/telegram.php',
              'laporan' => 'admin/laporan/laporan.php',
              'logout' => 'logout.php',
              'aduan_view' => 'pengadu/aduan/adu_tampil.php',
              'aduan_tambah' => 'pengadu/aduan/adu_tambah.php',
              'aduan_ubah' => 'pengadu/aduan/adu_ubah.php',
              'aduan_hapus' => 'pengadu/aduan/adu_hapus.php'
            ];

            // Define an array for default pages based on user level
            $defaultPages = [
              'Administrator' => 'default/admin.php',
              'Petugas' => 'default/tugas.php',
              'Pengadu' => 'default/pengadu.php'
            ];

            // Get the requested page from the URL query parameter.
            $hal = $_GET['page'] ?? null;

            // Include the appropriate file based on the request, or go to the default page based on user level.
            if (isset($pageMap[$hal])) {
              include $pageMap[$hal];
            } elseif (isset($defaultPages[$data_level])) {
              include $defaultPages[$data_level];
            } else {
              echo "<center><h1> ERROR !</h1></center>";
            }

            ?>

          </div>
        </div>

        <script>
          function confirmLogout() {
            Swal.fire({
              title: 'Apakah Anda Yakin?',
              text: "Apakah anda yakin ingin keluar dari aplikasi ini?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Keluar',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                // Redirect ke halaman logout
                window.location.href = "logout";
              }
            })
          }
        </script>

        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src='assets/js/jquery-1.10.2.js' defer></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src='assets/js/bootstrap.min.js' defer></script>
        <!-- METISMENU SCRIPTS -->
        <script src='assets/js/jquery.metisMenu.js' defer></script>
        <!-- CUSTOM SCRIPTS -->

        <script src='assets/js/dataTables/jquery.dataTables.js' defer></script>
        <script src='assets/js/dataTables/dataTables.bootstrap.js' defer></script>
        <script>
          $(document).ready(function() {
            $('#dataTables-example').dataTable();
          });
        </script>

        <script src='dist/js/select2.full.min.js' defer></script>
        <script>
          $(document).ready(function() {
            $("#no_pdd").select2({
              placeholder: "-- Pilih Penduduk --"
            });
            $("#no_kk").select2({
              placeholder: "-- Pilih No.KK --"
            });
          });
        </script>
        <!-- CUSTOM SCRIPTS -->
        <script src='assets/js/custom.js' defer></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9' defer></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</body>

</html>