<?php
$author = $data_id;

function getChatIds($koneksi)
{
  $ids = [];
  $sql = $koneksi->query("SELECT * from tb_telegram");
  while ($data = $sql->fetch_assoc()) {
    $ids[] = $data['id_chat'];
  }
  return $ids;
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

$chatIds = getChatIds($koneksi);
?>

<div class="panel panel-info">
  <div class="panel-heading">
    <i class="glyphicon glyphicon-plus"></i>
    <b>Tambah Aduan</b>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama Anda</label>
            <input class="form-control" name="judul" placeholder="Masukan Nama Anda" required />
          </div>
          <div class="form-group">
            <label>No Hp/Whatsapp</label>
            <input class="form-control" name="no_telpon" placeholder="Masukan Nomor Aktif" required />
          </div>
          <hr>
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
          <!-- Menggantikan input alamat dengan tombol pilih lokasi -->
          <div class="form-group">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mapModal">Pilih Lokasi</button>
            <input type="hidden" id="hiddenLat" name="lat">
            <input type="hidden" id="hiddenLng" name="lng">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan" rows="4" placeholder="Keterangan Aduan" required></textarea>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" required />
          </div>

          <div>
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
            <a href="?page=aduan_view" title="Kembali" class="btn btn-default">Batal</a>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div id="map" style="width: 100%; height: 400px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="saveMarkerData()">Simpan</button>
        <button type="button" class="btn btn-info" onclick="moveToCurrentLocation()">Lokasi Saya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  var map;
  var currentMarker;
  var savedMarkerData = null; // Untuk menyimpan data marker sementara

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: -7.010283,
        lng: 110.389072
      },
      zoom: 8
    });

    google.maps.event.addListener(map, 'rightclick', function(event) {
      placeMarker(event.latLng);
    });

    var longpressTimer;
    var startPressTime;

    google.maps.event.addListener(map, 'mousedown', function(event) {
      startPressTime = new Date().getTime();
      longpressTimer = setTimeout(function() {
        placeMarker(event.latLng);
      }, 1000);
    });

    google.maps.event.addListener(map, 'mouseup', function(event) {
      clearTimeout(longpressTimer);
    });

    google.maps.event.addListener(map, 'mousemove', function(event) {
      clearTimeout(longpressTimer);
    });
  }

  function placeMarker(location) {
    if (currentMarker) {
      currentMarker.setMap(null);
    }
    currentMarker = new google.maps.Marker({
      position: location,
      map: map
    });
  }

  function saveMarkerData() {
    var markerData = getMarkerData();
    if (markerData) {
      document.getElementById('hiddenLat').value = markerData.lat;
      document.getElementById('hiddenLng').value = markerData.lng;

      Swal.fire({
        title: 'Success!',
        text: 'Data saved.',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    } else {
      Swal.fire({
        title: 'Error!',
        text: 'No marker to save.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  }


  function submitMarkerData() {
    if (savedMarkerData) {
      // Add the 'method: "POST"' line to specify that this is a POST request.
      fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
          method: "POST",
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `lat=${savedMarkerData.lat}&lng=${savedMarkerData.lng}`
        })
        .then(response => response.text())
        .then(data => alert(data))
        .catch((error) => {
          console.error('Fetch Error:', error);
        });
    } else {
      alert("No marker data to submit.");
    }
  }

  function getMarkerData() {
    if (currentMarker) {
      var position = currentMarker.getPosition();
      return {
        lat: position.lat(),
        lng: position.lng()
      };
    }
    return null;
  }

  function moveToCurrentLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        map.setCenter(pos);
        placeMarker(pos);
      }, function() {
        handleLocationError(true);
      });
    } else {
      handleLocationError(false);
    }
  }

  function handleLocationError(browserHasGeolocation) {
    alert(browserHasGeolocation ?
      'Error: The Geolocation service failed.' :
      'Error: Your browser doesn\'t support geolocation.');
  }

  $('#mapModal').on('shown.bs.modal', function() {
    google.maps.event.trigger(map, "resize");
    moveToCurrentLocation();
  });
</script>


<?php

// Removed the line that collects 'alamat' from $_POST
if (isset($_POST['Simpan'])) {
  // Collect form data
  $aduan = $_POST['judul'];
  $no_telp = $_POST['no_telpon'];
  $lat = $_POST['lat'];  // Menerima latitude dari form
  $lng = $_POST['lng'];  // Menerima longitude dari form

  $sumber = $_FILES['foto']['tmp_name'];
  $nama_file = $_FILES['foto']['name'];
  $pindah = move_uploaded_file($sumber, 'foto/' . $nama_file);

  // Using prepared statement for safer SQL insertion
  // Removed 'alamat' column and parameter from the query
  $stmt = $koneksi->prepare("INSERT INTO tb_pengaduan (`judul`, `no_telpon`, `jenis`, `keterangan`, `foto`, `author`, `lat`, `lng`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  // Removed $alamat from bind_param
  $stmt->bind_param("ssssssss", $aduan, $no_telp, $_POST['jenis'], $_POST['keterangan'], $nama_file, $author, $lat, $lng);

  // Debug line to display the values of $lat and $lng
  // echo "Lat: $lat, Lng: $lng";

  $query_simpan = $stmt->execute();


  if ($query_simpan) {
    echo "<script>
              Swal.fire({title: 'Tambah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?page=aduan_view';
                  }
              })
            </script>";

    // Send messages
    $token_wa = "kQXDoqDmuLDAN!owWbbQ";
    $wa_admin = "0895377897675,082134420080";
    $messageAdmin = "INFO PENGADUAN PENERANGAN JALAN UMUM

Nama Pengirim : $aduan
Alamat              : [Lihat Lokasi](https://www.google.com/maps/?q=$lat,$lng)
Nomor Telpon   : $no_telp 

Memerlukan penanganan Terimakasih.";
    sendMessage($token_wa, $wa_admin, $messageAdmin);

    $messageUser = "INFO PENGADUAN PENERANGAN JALAN UMUM

Halo $aduan !!!
Terimakasih telah menghubungi kami
Kami akan segera menangani aduan anda
Tunggu pemberitahuan selanjutnya dari kami

Terimakasih.";
    sendMessage($token_wa, $no_telp, $messageUser);
  } else {
    echo "<script>
              Swal.fire({title: 'Tambah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?page=aduan_view';
                  }
              })
            </script>";
  }
}
?>

<!-- end -->