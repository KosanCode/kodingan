<?php
	//koneksi ke database

	$koneksi = mysqli_connect("localhost","root","", "kamabaa");
	
	function query($query){
		global $koneksi;
		$result = mysqli_query($koneksi, $query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result) ){
			$rows[] = $row;
		}
			return $rows;
	}
	
	function cari($keyword) {
		$query = "SELECT * FROM tabelberita
					WHERE 
					judul like '$keyword%'";
		return query($query);
	}
	
	function simpankom ($komentar) {
		global $koneksi;
		
		$kd_berita = $_GET["kd_berita"];
		$tanggal = date("Y-m-d h:i:s");
		
		$query = "INSERT INTO tabelkomentar(tanggal, komentar, kd_berita) VALUES('$tanggal', '$komentar', '$kd_berita')";
		
		$result = mysqli_query($koneksi, $query);
		$rows = [];
		while ( $row = mysqli_fetch_array($result)) {
			$rows[] = $row;
		}
		return $rows;
	}
	
	function hapus ($id, $kd_berita) {
		global $koneksi;
		mysqli_query($koneksi, "DELETE FROM tabelkomentar where kd_berita = $kd_berita and kd_komentar = $id");
		return mysqli_affected_rows($koneksi);
	}

?>