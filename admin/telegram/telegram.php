<?php
$sql_cek = "SELECT * FROM tb_telegram limit 1";
$query_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
?>

<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-bell"></i>
		<b>ID Telegram</b>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST">

					<div class="form-group">
						<input type='hidden' class="form-control" name="id_telegram" value="<?php echo $data_cek['id_telegram']; ?>" readonly />
					</div>

					<div class="form-group">
						<label>User</label>
						<input class="form-control" name="user" value="<?php echo $data_cek['user']; ?>" />
					</div>

					<div class="form-group">
						<label>Id Chat</label>
						<input class="form-control" name="id_chat" value="<?php echo $data_cek['id_chat']; ?>" />
					</div>
					<div>
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
					</div>

			</div>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST['Ubah'])) {

	$sql_ubah = "UPDATE tb_telegram SET user='" . $_POST['user'] . "', id_chat='" . $_POST['id_chat'] . "'
		WHERE id_telegram='" . $_POST['id_telegram'] . "'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);

	if ($query_ubah) {
		echo "<script>
        Swal.fire({title: 'Ubah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=telegram';
            }
        })</script>";
	} else {
		echo "<script>
        Swal.fire({title: 'Ubah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
            {window.location = 'index.php?page=telegram';
            }
        })</script>";
	}
}
?>
<!-- end -->