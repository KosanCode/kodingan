<?php

	include '../functionkegiatan.php';	
	
	$kd_kegiatan = $_GET["kd_kegiatan"];

	if( hapuskeg($kd_kegiatan) > 0){
		echo "
					<script>
						alert('DATA BERHASIL DIHAPUS');
						document.location.href = 'data_kegiatan.php';
					</script>
			";
	}else {
		echo "
					<script>
						alert('DATA GAGAS DIHAPUS!');
						document.location.href = 'data_kegiatan.php';
					</script>
			";
	}

?>