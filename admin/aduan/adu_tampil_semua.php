<!-- refactored -->

<div class="panel panel-info">
  <div class="panel-heading">
    <i class="glyphicon glyphicon-book"></i>
    <b>Data Aduan</b>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No</th>
            <th>Pengadu</th>
            <th>No Telp</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Alamat</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $query = "SELECT a.id_pengaduan, a.judul, a.no_telpon, a.foto, a.lat, a.lng, a.status, j.jenis, p.nama_pengadu, p.no_hp 
                    FROM tb_pengaduan a 
                    JOIN tb_jenis j ON a.jenis=j.id_jenis 
                    JOIN tb_pengadu p ON a.author=p.id_pengadu";
          $result = $koneksi->query($query);

          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['nama_pengadu']}</td>";
            echo "<td>{$row['no_telpon']}</td>";
            echo "<td>{$row['judul']}</td>";
            echo "<td>{$row['jenis']}</td>";
            $googleMapsLink = "https://www.google.com/maps/?q={$row['lat']},{$row['lng']}";
            echo "<td><a href='{$googleMapsLink}' target='_blank'>Buka Alamat</a></td>";
            $imgSrc = "foto/{$row['foto']}";
            echo "<td><img src='{$imgSrc}' width='100px' onClick='window.open(this.src)' role='button' tabIndex='0' /></td>";

            $status = $row['status'];
            $labelClass = $status === 'Proses' ? 'warning' : ($status === 'Tanggapi' ? 'success' : 'primary');
            echo "<td><span class='label label-{$labelClass}'>{$status}</span></td>";

            $manageLink = "?page=aduan_kelola&kode={$row['id_pengaduan']}";
            echo "<td><a href='{$manageLink}' title='Tanggapi' class='btn btn-primary btn-sm'><i class='glyphicon glyphicon-check'></i></a></td>";
            echo "</tr>";
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>