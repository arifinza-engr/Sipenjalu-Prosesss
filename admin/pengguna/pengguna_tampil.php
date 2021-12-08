<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-book"></i>
		<b>Data Pengguna</b>
	</div>
	<div class="panel-body">

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>usernaname</th>
						<th>Password</th>
						<th>Level</th>
						<th>Aksi</th>

					</tr>

				</thead>
				<tbody>
					<?php
                        $no = 1;
                        $sql = $koneksi->query("select * from tb_pengguna order by grup asc");
                        while ($data= $sql->fetch_assoc()) {
                    ?>
					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_pengguna']; ?>
						</td>
						<td>
							<?php echo $data['username']; ?>
						</td>
						<td>
							<?php echo $data['password']; ?>
						</td>
						<td>
							<?php echo $data['level']; ?>
						</td>
						<td>
							<?php $grup = $data['grup'];?>
							<?php if($grup == "A"){?>
							<a href="?page=pengguna_ubah&kode=<?php echo $data['id_pengguna']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
							<a href="?page=pengguna_hapus&kode=<?php echo $data['id_pengguna']; ?>" onclick="return confirm('Apakah anda yakin hapus pengguna ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="glyphicon glyphicon-trash"></i>
							</a>

							<?php }else{ ?>
							<a href="?page=pedu_ubah&kode=<?php echo $data['id_pengguna']; ?>" title="Ubah"
							 class="btn btn-warning btn-sm">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
							<?php } ?>

						</td>

					</tr>

					<?php
                        }
                    ?>
					<a href="?page=pengguna_tambah" class="btn btn-primary">
						<i class="glyphicon glyphicon-plus"></i> Tambah</a>
					<br>
					<br>
				</tbody>
		</div>
	</div>
</div>