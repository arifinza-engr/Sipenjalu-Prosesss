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
          $stmt = $koneksi->prepare("SELECT a.id_pengaduan, a.judul, a.no_telpon, a.foto, a.lat, a.lng, a.status, j.jenis, p.nama_pengadu, p.no_hp
                        FROM tb_pengaduan a
                        JOIN tb_jenis j ON a.jenis = j.id_jenis
                        JOIN tb_pengadu p ON a.author = p.id_pengadu
                        WHERE status = ?");
          $status = 'Selesai';
          $stmt->bind_param('s', $status);
          $stmt->execute();
          $result = $stmt->get_result();

          while ($data = $result->fetch_assoc()) {
            echo generateRow($data, $no++);
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
function generateRow($data, $no)
{
  $statusLabel = getStatusLabel($data['status']);
  $lat = $data['lat'];
  $lng = $data['lng'];
  return "
    <tr>
        <td>$no</td>
        <td>{$data['nama_pengadu']}</td>
        <td>{$data['no_telpon']}</td>
        <td>{$data['judul']}</td>
        <td>{$data['jenis']}</td>
        <td><a href='https://www.google.com/maps/?q=$lat,$lng' target='_blank'>Buka Alamat</a></td>
        <td><img src='foto/{$data['foto']}' width='100px' onclick='window.open(this.src)' role='button' tabindex='0'></td>
        <td><span class='label $statusLabel[0]'>$statusLabel[1]</span></td>
        <td><a href='?page=aduan_kelola&kode={$data['id_pengaduan']}' title='Tanggapi' class='btn btn-primary btn-sm'><i class='glyphicon glyphicon-check'></i></a></td>
    </tr>";
}

function getStatusLabel($status)
{
  switch ($status) {
    case 'Proses':
      return ['label-warning', 'menunggu'];
    case 'Tanggapi':
      return ['label-success', 'Ditanggapi'];
    case 'Selesai':
      return ['label-primary', 'Selesai'];
    default:
      return ['label-default', 'Unknown'];
  }
}
?>