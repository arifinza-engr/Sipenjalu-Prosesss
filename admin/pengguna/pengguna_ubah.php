<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_pengguna WHERE id_pengguna='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>


<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-edit"></i>
		<b>Ubah Pengguna</b>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST">

					<div class="form-group">
						<input type='hidden' class="form-control" name="id_pengguna" value="<?php echo $data_cek['id_pengguna']; ?>"
						 readonly/>
					</div>

					<div class="form-group">
						<label>Nama lengkap</label>
						<input class="form-control" name="nama_pengguna" value="<?php echo $data_cek['nama_pengguna']; ?>"
						/>
					</div>

					<div class="form-group">
						<label>Username</label>
						<input class="form-control" name="username" value="<?php echo $data_cek['username']; ?>"
						/>
					</div>

					<div class="form-group">
						<label>Password</label>
						<input class="form-control" name="password" value="<?php echo $data_cek['password']; ?>"
						/>
					</div>

					<div class="form-group">
						<label>Level :</label>
						<select name="level" class="form-control">
							<?php
                            //menhecek data yg dipilih sebelumnya
                            if ($data_cek['level'] == "Administrator") echo "<option value='Administrator' selected>Administrator</option>";
                            else echo "<option value='Administrator'>Administrator</option>";
            
                            if ($data_cek['level'] == "Petugas") echo "<option value='Petugas' selected>Petugas</option>";
                            else echo "<option value='Petugas'>Petugas</option>";
                        ?>
						</select>
					</div>

					<div>
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
						<a href="?page=user_data" title="Kembali" class="btn btn-default">Batal</a>
					</div>

			</div>
			</form>
		</div>

	</div>
</div>
</div>


<?php

if (isset ($_POST['Ubah'])){
    
    $sql_ubah = "UPDATE tb_pengguna SET
        nama_pengguna='".$_POST['nama_pengguna']."',
        username='".$_POST['username']."',
        password='".$_POST['password']."',
        level='".$_POST['level']."'
        WHERE id_pengguna='".$_POST['id_pengguna']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=user_data';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=user_data';
            }
        })</script>";
    }
}
?>
<!-- end -->