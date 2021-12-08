<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-book"></i>
		<b>Data Pengadu</b>
	</div>
	<div class="panel-body">

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>JK</th>
						<th>No HP</th>
						<th>Alamat</th>
						<th>Aksi</th>

					</tr>

				</thead>
				<tbody>
					<?php
                        $no = 1;
                        $sql = $koneksi->query("select * from tb_pengadu");
                        while ($data= $sql->fetch_assoc()) {
                    ?>
					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_pengadu']; ?>
						</td>
						<td>
							<?php echo $data['jekel']; ?>
						</td>
						<td>
							<?php echo $data['no_hp']; ?>
						</td>
						<td>
							<?php echo $data['alamat']; ?>
						</td>

						<td>
							<a href="?page=pengadu_ubah&kode=<?php echo $data['id_pengadu']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
							<a href="?page=pengadu_hapus&kode=<?php echo $data['id_pengadu']; ?>" onclick="return confirm('Apakah anda yakin hapus pengadu ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="glyphicon glyphicon-trash"></i>
						</td>
					</tr>

					<?php
                        }
                    ?>
					<a href="?page=pengadu_tambah" class="btn btn-primary">
						<i class="glyphicon glyphicon-plus"></i> Tambah</a>
					<br>
					<br>
				</tbody>
		</div>
	</div>
</div>