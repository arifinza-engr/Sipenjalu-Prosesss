<?php

session_start();
if (isset($_SESSION['ses_nama']) == "") {
  header("location: login");
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
  <link rel="stylesheet" href="dist/css/select2.min.css" />

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
      <?php if ($data_level == "Administrator") { ?>
        <div style="float : right;">
          <a href="logout" onclick="return confirm('Apakah anda yakin ingin keluar dari aplikasi ini ?')" class="btn btn-danger square-btn-adjust">LOGOUT</a>
        </div>
      <?php
      }
      ?>
      <?php if ($data_level == "Petugas") { ?>
        <div style="float : right;">
          <a href="logout" onclick="return confirm('Apakah anda yakin ingin keluar dari aplikasi ini ?')" class="btn btn-danger square-btn-adjust">LOGOUT</a>
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

            <li>
              <a href="?page=telegram">
                <i class="fa fa-comments-o fa-2x"></i> Telegram</a>
            </li>

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
            if (isset($_GET['page'])) {
              $hal = $_GET['page'];

              switch ($hal) {
                case 'admin-def':
                  include "default/admin.php";
                  break;
                case 'petugas-def':
                  include "default/tugas.php";
                  break;
                case 'pengadu':
                  include "default/pengadu.php";
                  break;

                  //User
                case 'user_data':
                  include "admin/pengguna/pengguna_tampil.php";
                  break;
                case 'pengguna_tambah':
                  include "admin/pengguna/pengguna_tambah.php";
                  break;
                case 'pengguna_ubah':
                  include "admin/pengguna/pengguna_ubah.php";
                  break;
                case 'pedu_ubah':
                  include "admin/pengguna/pedu_ubah.php";
                  break;
                case 'pengguna_hapus':
                  include "admin/pengguna/pengguna_hapus.php";
                  break;

                  //jenis
                case 'jenis_view':
                  include "admin/jenis/jenis_tampil.php";
                  break;
                case 'jenis_tambah':
                  include "admin/jenis/jenis_tambah.php";
                  break;
                case 'jenis_ubah':
                  include "admin/jenis/jenis_ubah.php";
                  break;
                case 'jenis_hapus':
                  include "admin/jenis/jenis_hapus.php";
                  break;

                  //pengadu
                case 'pengadu_view':
                  include "admin/pengadu/pengadu_tampil.php";
                  break;
                case 'pengadu_tambah':
                  include "admin/pengadu/pengadu_tambah.php";
                  break;
                case 'pengadu_ubah':
                  include "admin/pengadu/pengadu_ubah.php";
                  break;
                case 'pengadu_hapus':
                  include "admin/pengadu/pengadu_hapus.php";
                  break;

                  //aduan admin
                case 'aduan_admin':
                  include "admin/aduan/adu_tampil.php";
                  break;
                case 'aduan_admin_tanggap':
                  include "admin/aduan/adu_tanggap.php";
                  break;
                case 'aduan_admin_selesai':
                  include "admin/aduan/adu_selesai.php";
                  break;
                case 'aduan_kelola':
                  include "admin/aduan/adu_ubah.php";
                  break;

                  //telegram
                case 'telegram':
                  include "admin/telegram/telegram.php";
                  break;

                case 'laporan':
                  include "admin/laporan/laporan.php";
                  break;
                  //logout
                case 'logout':
                  include "logout.php";
                  break;

                  //aduan
                case 'aduan_view':
                  include "pengadu/aduan/adu_tampil.php";
                  break;
                case 'aduan_tambah':
                  include "pengadu/aduan/adu_tambah.php";
                  break;
                case 'aduan_ubah':
                  include "pengadu/aduan/adu_ubah.php";
                  break;
                case 'aduan_hapus':
                  include "pengadu/aduan/adu_hapus.php";
                  break;


                  //default
                default:
                  echo "<center><h1> ERROR !</h1></center>";
                  break;
              }
            } else {
              if ($data_level == "Administrator") {
                include "default/admin.php";
              } elseif ($data_level == "Petugas") {
                include "default/tugas.php";
              } elseif ($data_level == "Pengadu") {
                include "default/pengadu.php";
              }
            }
            ?>
          </div>
        </div>



        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
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

        <script src="dist/js/select2.min.js"></script>
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
        <script src="assets/js/custom.js"></script>


</body>

</html>