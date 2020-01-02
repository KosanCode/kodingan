<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil Data yang Dikirim dari Form
$judul = $_POST['judul'];
$nama = $_POST['nama'];
$tanggal = date("Y-m-d");
$isi = $_POST['isi'];
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];
  
// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$gambar;
// Set path folder tempat menyimpan fotonya
$path = "images/Berita/".$fotobaru;
// Proses upload
if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak


  
  // Proses simpan ke Database
  $query = "INSERT INTO tabelberita(judul, nama, tanggal,isi, namagambar, gambar) VALUES('".$judul."', '".$nama."', '".$tanggal."', '".$isi."', '".$fotobaru."', '".$tmp."')";
  $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo "Data berhasil di tambahkan";
	echo "<br><a href='form_berita.php'>Kembali Ke Form</a>";	// Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='form_berita.php'>Kembali Ke Form</a>";
  }
}else{
  // Jika gambar gagal diupload, Lakukan :
  echo "Maaf, Gambar gagal untuk diupload.";
  echo "<br><a href='form_berita.php'>Kembali Ke Form</a>";
}
?>