<?php
	include 'functionkegiatan.php';	


	if (isset($_POST['submit'])) {

		if( tambahkeg($_POST) > 0){
			echo "
					<script>
						alert('DATA BERHASIL DITAMBAHKAN!');
						document.location.href = 'showdatakeg.php';
					</script>
			";
		} else {
			echo "
					<script>
						alert('DATA GAGAL DITAMBAHKAN!');
						document.location.href = 'showdatakeg.php';
					</script>
			";
		}
		

		

	}
?>


<form action="#"  method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Nama Kegiatan</td>
			<td>: <input type="text" name="kegiatan" style="width: 510px;" required></td>
		</tr>
		<tr>
			<td valign="top">Deskripsi Kegiatan</td>
			<td>: <textarea rows="20" cols="70" name="detail" required></textarea></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: <input type="date" name="tanggal" required></td>
		</tr>
		<tr>
			<td>Tempat</td>
			<td>: <input type="text" name="tempat" style="width: 510px;" required></td>
		</tr>
		<tr>
			<td>Iuran</td>
			<td>: Rp <input type="text" name="iuran" style="width: 150px;"></td>
		</tr>
		<tr>
			<td>Gambar</td>
			<td>: <input type="file" name="gambar"></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<button type="submit" name="submit">Tambah Data</button>
			</td>
		</tr>
	</table>
</form>

