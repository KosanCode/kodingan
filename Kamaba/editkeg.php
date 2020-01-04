<?php
	include 'functionkegiatan.php';	


	if (isset($_POST['submit'])) {

		if( editkeg($_POST) > 0){
			echo "
					<script>
						alert('DATA BERHASIL DIEDIT!');
						document.location.href = 'showdatakeg.php';
					</script>
			";
		} else {
			echo "
					<script>
						alert('DATA GAGAL DIEDIT!');
						document.location.href = 'showdatakeg.php';
					</script>
			";
		}
	}

	//ambil data di url
	$kd_kegiatan = $_GET["kd_kegiatan"];
	// 

	$keg = query("SELECT * FROM kegiatan WHERE kegiatan.kd_kegiatan = $kd_kegiatan")[0];


?>


<form action="#"  method="post" enctype="multipart/form-data">
	<table>
		<input type="hidden" name="kd_kegiatan" value="<?= $keg["kd_kegiatan"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $keg["gambar"]; ?>">
		<tr>
			<td>Nama Kegiatan</td>
			<td>: <input type="text" name="kegiatan" value="<?= $keg["kegiatan"]; ?>" required></td>
		</tr>
		<tr>
			<td valign="top">Deskripsi Kegiatan</td>
			<td>: <textarea rows="10" cols="50" name="detail" required><?= $keg["detail"]; ?></textarea></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: <input type="date" name="tanggal" value="<?= $keg["tanggal"]; ?>" required></td>
		</tr>
		<tr>
			<td>Tempat</td>
			<td>: <input type="text" name="tempat" value="<?= $keg["tempat"]; ?>" required></td>
		</tr>
		<tr>
			<td>Iuran</td>
			<td>: <input type="text" name="iuran" value="<?= $keg["iuran"]; ?>"></td>
		</tr>
		<tr>
			<td valign="top">Gambar</td>
			<td>: <img src="images/<?= $keg["gambar"]; ?>" width="200px"> 
				<br>
				<input type="file" name="gambar"></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<button type="submit" name="submit">Edit Data</button>
			</td>
		</tr>
	</table>
</form>

