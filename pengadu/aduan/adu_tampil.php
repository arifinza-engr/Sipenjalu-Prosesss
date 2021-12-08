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
            <th>Nama</th>
            <th>Jenis</th>
            <th>Alamat</th>
            <th>Foto</th>
            <th>status</th>
            <th>Aksi</th>

          </tr>

        </thead>
        <tbody>
          <?php $author = $data_id ?>
          <?php
          $no = 1;
          $sql = $koneksi->query("select a.id_pengaduan, a.judul, a.alamat, a.foto, a.status, j.jenis 
						from tb_pengaduan a join tb_jenis j on a.jenis=j.id_jenis where author='$author'");
          while ($data = $sql->fetch_assoc()) {
          ?>
            <tr>
              <td>
                <?php echo $no++; ?>
              </td>
              <td>
                <?php echo $data['judul']; ?>
              </td>
              <td>
                <?php echo $data['jenis']; ?>
              </td>
              <td>
                <?php echo $data['alamat']; ?>
              </td>
              <td>
                <img src="foto/<?php echo $data['foto']; ?>" width="100px" onClick="window.open(this.src)" role="button" tabIndex="0" />
              </td>
              <td>
                <?php $stt = $data['status']  ?>
                <?php if ($stt == 'Proses') { ?>
                  <span class="label label-warning">Menunggu</span>
                <?php } elseif ($stt == 'Tanggapi') { ?>
                  <span class="label label-success">Ditanggapi</span>
                <?php } else { ?>
                  <span class="label label-primary">Selesai</span>
              </td>
            <?php } ?>

            <td>
              <?php $stt = $data['status']  ?>
              <?php if ($stt == 'Proses') { ?>
                <a href="?page=aduan_ubah&kode=<?php echo $data['id_pengaduan']; ?>" title="Ubah" class="btn btn-success btn-sm">
                  <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a href="?page=aduan_hapus&kode=<?php echo $data['id_pengaduan']; ?>" onclick="return confirm('Apakah anda yakin hapus pengadu ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                  <i class="glyphicon glyphicon-trash"></i>
                </a>
              <?php } else { ?>
                -
            </td>
          <?php } ?>

            </tr>

          <?php
          }
          ?>
          <a href="?page=aduan_tambah" class="btn btn-primary">
            <i class="glyphicon glyphicon-plus"></i> Tambah</a>
          <br>
          <br>
        </tbody>
    </div>
  </div>
</div>