<?php
 require "koneksi.php"; 
 
 $id = $_GET["id"];
 $kd_berita = $_GET["kd_berita"];
 
 hapus($id, $kd_berita);
 
 header("location:blog-single.php?kd_berita=$kd_berita");
  
?>