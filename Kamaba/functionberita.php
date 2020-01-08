<?php
	//koneksi ke database

	//$koneksi = mysqli_connect("localhost","root","", "kamabaa");
	
	include 'koneksi.php';

	//datakeg = data kegiatan
	function tambahberita($databerita){
		global $koneksi;

		$judul = htmlspecialchars($databerita['judul']);
		$nama = htmlspecialchars($databerita['nama']);
		$tanggal = date("Y-m-d");
		$isi = htmlspecialchars($databerita['isi']);

		//upload gambar
		$gambar = upload();
		if( !$gambar ){
			return false;
		}


		$query = "INSERT INTO tabelberita  VALUES ('','$judul','$nama','$tanggal','$isi','$gambar')" or die(mysqli_error());

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


		move_uploaded_file($tmpName, '../images/berita/' . $namaFilebaru);

		return $namaFilebaru;




	}

	function hapusberita($kd_berita){
		global $koneksi;
	
		$query4 = "DELETE FROM tabelkomentar WHERE kd_berita = $kd_berita";
		$query3 = "DELETE FROM tabelberita WHERE kd_berita = $kd_berita";
		$hasil = mysqli_query($koneksi, $query4);
		$hasil = mysqli_query($koneksi, $query3);
		return mysqli_affected_rows($koneksi); 
	}

	function editberita($databerita){
		global $koneksi;

		$kd_berita = $databerita["kd_berita"];
		
		$judul = htmlspecialchars($databerita['judul']);
		$nama = htmlspecialchars($databerita['nama']);
		$tanggal = date("Y-m-d");
		$isi = htmlspecialchars($databerita['isi']);
		
		$gambarLama = $databerita["gambarLama"];

		//cek gambar baru atau tidak
		if ( $_FILES['gambar']['error'] === 4 ) {
			$gambar = $gambarLama;
		} else{
			$gambar = upload();
		}


		

		$query = "	UPDATE tabelberita 
					SET 
						judul = '$judul', 
						nama = '$nama', 
						tanggal = '$tanggal', 
						isi = '$isi', 
						namagambar = '$gambar'  
					WHERE kd_berita = $kd_berita";

		$hasil = mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);

	}

	function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
	}


?>