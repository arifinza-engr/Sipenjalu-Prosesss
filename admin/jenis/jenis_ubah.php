<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_jenis WHERE id_jenis='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>


<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-edit"></i>
		<b>Ubah Jenis</b>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST">

					<div class="form-group">
						<input type='hidden' class="form-control" name="id_jenis" value="<?php echo $data_cek['id_jenis']; ?>"
						 readonly/>
					</div>

					<div class="form-group">
						<label>Jenis Aduan</label>
						<input class="form-control" name="jenis" value="<?php echo $data_cek['jenis']; ?>"
						/>
					</div>
					<div>
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
						<a href="?page=jenis_view" title="Kembali" class="btn btn-default">Batal</a>
					</div>

			</div>
			</form>
		</div>

	</div>
</div>
</div>


<?php

if (isset ($_POST['Ubah'])){
    
    $sql_ubah = "UPDATE tb_jenis SET
        jenis='".$_POST['jenis']."' WHERE id_jenis='".$_POST['id_jenis']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=jenis_view';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=jenis_view';
            }
        })</script>";
    }
}
?>
<!-- end -->