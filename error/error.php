<?php

$error = $_SERVER["REDIRECT_STATUS"];

$error_tittle = '';
$error_message = '';
$error_sub = '';

if ($error == 404) {
  $error_tittle = '404 Page Not Found';
  $error_message = 'Halaman Tidak Ditemukan';
  $error_sub = 'Pastikan URL yang anda tuju benar.';
} elseif ($error == 403) {
  $error_tittle = '403 Access Denied';
  $error_message = 'Silahkan hubungi <a href="https://www.instagram.com/arifinza.engr/">arifinza.engr</a> untuk info lebih lanjut.';
  $error_sub = 'Akses ditolak untuk mengakses halaman ini.';
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link rel="stylesheet" href="/sipenjalu/assets/css/error.css">

  <title><?php echo $error_tittle; ?></title>
</head>

<body>
  <div class="container text-white" style="margin-top:150px">
    <div class="jumbotron" style="background-image: url('/sipenjalu/assets/img/403.jpg');" width="100%" height="100%">
      <h1 class="display-4"><?php echo $error_tittle; ?></h1>
      <p class="lead"><?php echo $error_sub; ?></p>
      <hr class="my-4">
      <p><?php echo $error_message; ?>.</p>
      <a class="btn btn-primary btn-md" href="/sipenjalu/index" role="button">Kembali</a>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>