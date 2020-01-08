<?php

	include '../functionberita.php';	
	
	$kd_berita = $_GET["kd_berita"];

	if( hapusberita($kd_berita) > 0){
		echo "
					<script>
						alert('DATA BERHASIL DIHAPUS');
						document.location.href = 'data_berita.php';
					</script>
			";
	}else {
		echo "
					<script>
						alert('DATA GAGAL DIHAPUS!');
						document.location.href = 'data_berita.php';
					</script>
			";
	}

?>