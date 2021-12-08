<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-plus"></i>
		<b>Tambah Pengguna</b>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST">

					<div class="form-group">
						<label>Nama Pengguna</label>
						<input class="form-control" name="nama_pengguna" placeholder="Nama Pengguna" required/>
					</div>

					<div class="form-group">
						<label>Username</label>
						<input class="form-control" name="username" placeholder="Username" required />
					</div>

					<div class="form-group">
						<label>Password</label>
						<input class="form-control" name="password" placeholder="Password" required/>
					</div>

					<div class="form-group">
						<label>Level :</label>
						<select name="level" class="form-control">
							<option value="">- Pilih -</option>
							<option>Petugas</option>
							<option>Administrator</option>
						</select>
					</div>

					<div>
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
						<a href="?page=user_data" title="Kembali" class="btn btn-default">Batal</a>
					</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php

    if (isset ($_POST['Simpan'])){
        
        $sql_simpan = "INSERT INTO tb_pengguna (id_pengguna,nama_pengguna,username,password,level,grup) VALUES (
        UUID(),
        '".$_POST['nama_pengguna']."',
        '".$_POST['username']."',
		'".$_POST['password']."',
		'".$_POST['level']."',
        'A')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=user_data';
                }
            })</script>";
            }else{
            echo "<script>
            Swal.fire({title: 'Tambah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=user_data';
                }
            })</script>";
        }
        }
?>
<!-- end -->