<?php
	//koneksi ke database

	//$koneksi = mysqli_connect("localhost","root","", "kamabaa");
	
	include 'koneksi.php';

	//datakeg = data kegiatan
	function tambahkeg($datakeg){
		global $koneksi;

		$kegiatan = htmlspecialchars($datakeg['kegiatan']);
		$tanggal = htmlspecialchars($datakeg['tanggal']);
		$tempat = htmlspecialchars($datakeg['tempat']);
		$detail = htmlspecialchars($datakeg['detail']);
		$iuran = htmlspecialchars($datakeg['iuran']);

		//upload gambar
		$gambar = upload();
		if( !$gambar ){
			return false;
		}


		$query = "INSERT INTO kegiatan  VALUES ('','$kegiatan','$tanggal','$tempat','$detail','$iuran','$gambar')" or die(mysqli_error());

		$hasil = mysqli_query($koneksi, $query );

		return mysqli_affected_rows($koneksi);
	}

	function upload(){

		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$errorFile = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];

		//cek apakah tidak ada gambar di upload
		if( $errorFile === 4){
			echo " 	<script>
						alert('Pilih Gambar terlebih dahulu');
					</script>";

					return false;
		}

		//cek gambar atau bukan
		$ekstensiGambarvalid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if ( !in_array($ekstensiGambar, $ekstensiGambarvalid)) { echo " 	<script>
						alert('Yang anda upload bukan gambar!');
					</script>";
			
				return false;
		}

		//cek ukuran besar
		if ( $ukuranFile > 5000000) {
			echo " 	<script>
						alert('Ukuran yang anda masukkan terlalu besar');
					</script>";
			
				return false;
		}
		
		//gambar siap upload
		//generate nama baru
		$namaFilebaru = uniqid();
		$namaFilebaru .= '.';
		$namaFilebaru .= $ekstensiGambar;


		move_uploaded_file($tmpName, 'images/' . $namaFilebaru);

		return $namaFilebaru;




	}

	function hapuskeg($kd_kegiatan){
		global $koneksi;

		$query3 = "DELETE FROM dtl_kegiatan WHERE kd_kegiatan = $kd_kegiatan";
		$query4 = "DELETE FROM kegiatan WHERE kd_kegiatan = $kd_kegiatan";

		$hasil = mysqli_query($koneksi, $query3);
		$hasil = mysqli_query($koneksi, $query4);

		return mysqli_affected_rows($koneksi); 
	}

	function editkeg($datakeg){
		global $koneksi;

		$kd_kegiatan = $datakeg["kd_kegiatan"];
		$kegiatan = htmlspecialchars($datakeg['kegiatan']);
		
		$detail = htmlspecialchars($datakeg['detail']);
		$tanggal = htmlspecialchars($datakeg['tanggal']);
		$tempat = htmlspecialchars($datakeg['tempat']);
		$iuran = htmlspecialchars($datakeg['iuran']);
		
		$gambarLama = $datakeg["gambarLama"];

		//cek gambar baru atau tidak
		if ( $_FILES['gambar']['error'] === 4 ) {
			$gambar = $gambarLama;
		} else{
			$gambar = upload();
		}


		

		$query = "	UPDATE kegiatan 
					SET 
						kegiatan = '$kegiatan',
						tanggal = '$tanggal', 
						tempat = '$tempat', 
						detail = '$detail', 
						iuran = '$iuran', 
						gambar = '$gambar'  
					WHERE kd_kegiatan = $kd_kegiatan";

		$hasil = mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);

	}

	function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
	}

	function daftarkeg($datakeg){
		global $koneksi;

		$kd_kegiatan = $datakeg["kd_kegiatan"];
		$kd_anggota = $datakeg["kd_anggota"];



		$query = "INSERT INTO dtl_kegiatan  VALUES ('$kd_kegiatan','$kd_anggota','y')";

		$hasil = mysqli_query($koneksi, $query );

		return mysqli_affected_rows($koneksi);


	}


?>