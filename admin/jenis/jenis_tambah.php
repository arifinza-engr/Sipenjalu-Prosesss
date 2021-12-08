<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-plus"></i>
		<b>Tambah Jenis</b>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST">

					<div class="form-group">
						<label>Tambah Jenis</label>
						<input class="form-control" name="jenis" placeholder="Nama Pengguna" required/>
					</div>

					<div>
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
						<a href="?page=jenis_view" title="Kembali" class="btn btn-default">Batal</a>
					</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php

    if (isset ($_POST['Simpan'])){
        
        $sql_simpan = "INSERT INTO tb_jenis (jenis) VALUES ('".$_POST['jenis']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=jenis_view';
                }
            })</script>";
            }else{
            echo "<script>
            Swal.fire({title: 'Tambah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=jenis_view';
                }
            })</script>";
        }
        }
?>
<!-- end -->