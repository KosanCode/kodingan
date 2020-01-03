<?php

//koneksi database
// $conn = mysqli_connect("localhost", "root","", "final_project"); 
require_once 'koneksi.php';


//registrasi
function registrasi($data) {
    global $koneksi;

    $name = strtoupper(stripslashes($data["name"]));
    $email = $data["email"];
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $pass2 = mysqli_real_escape_string($koneksi, $data["pass2"]);

    //cek email sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT email FROM login WHERE email = '$email'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Email sudah terdaftar!');
          </script>";

        return false;
    }
    
    //cek konfirmasi password
    if ( $password !== $pass2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
          </script>";

        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($koneksi, "INSERT INTO login VALUES('',  '$email', '$password', '$name', 'user')");

    return mysqli_affected_rows($koneksi);
}

//pendaftaran
function pendaftaran($dataMember){
  global $koneksi;

  $nama = htmlspecialchars($dataMember['nama']);
  $jk = $dataMember['jk'];
  $tempat_lahir = htmlspecialchars($dataMember['tempat_lahir']);
  $tanggal_lahir = htmlspecialchars($dataMember['tanggal_lahir']);
  $alamat_asal = htmlspecialchars($dataMember['alamat_asal']);
  $alamat_yk = htmlspecialchars($dataMember['alamat_yk']);
  $asal_kampus = htmlspecialchars($dataMember['asal_kampus']);
  $angkatan = htmlspecialchars($dataMember['angkatan']);
  $telp = htmlspecialchars($dataMember['telp']);

  //upload gambar
  $foto = uploadProfile();
  if( !$foto ){
    return false;
  }

  $user_terlogin = @$_SESSION['user'];

  $query = "INSERT INTO anggota VALUES ('','$nama','$jk','$tempat_lahir', '$tanggal_lahir', '$alamat_asal', '$alamat_yk', '$asal_kampus', '$angkatan', '$telp', '$foto',16 ,'$user_terlogin')";

  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function uploadProfile(){

  $namaFile = $_FILES['foto']['name'];
  $ukuranFile = $_FILES['foto']['size'];
  $errorFile = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];

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
  if ( !in_array($ekstensiGambar, $ekstensiGambarvalid)) { 
    echo " 	<script>
              alert('Yang anda upload bukan gambar!');
            </script>";
    
    return false;
  }

  //cek ukuran
  if ( $ukuranFile > 2000000) {
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


  move_uploaded_file($tmpName, 'images/user/' . $namaFilebaru);

  return $namaFilebaru;
}

//update profile
function updateProfile($dataMember){
  global $koneksi;

  $nama = htmlspecialchars($dataMember['nama']);
  $jk = $dataMember['jk'];
  $tmp_lahir = htmlspecialchars($dataMember['tmp_lahir']);
  $tgl_lahir = htmlspecialchars($dataMember['tgl_lahir']);
  $alamat_asal = htmlspecialchars($dataMember['alamat_asal']);
  $alamat_jogja = htmlspecialchars($dataMember['alamat_jogja']);
  $asal_kampus = htmlspecialchars($dataMember['asal_kampus']);
  $angkatan = htmlspecialchars($dataMember['angkatan']);
  $telpon = htmlspecialchars($dataMember['telpon']);

  $user_terlogin = @$_SESSION['user'];
  $sql_user = mysqli_query($koneksi, "SELECT nia,foto, kd_jabatan FROM anggota WHERE id = '$user_terlogin'") or die(mysql_error());
  $data =  mysqli_fetch_array($sql_user);

  $nia = $data['nia'];
  $foto = $data['foto'];
  $kd_jabatan = $data['kd_jabatan'];

  $query = "UPDATE anggota SET 
            nama = '$nama', jk = '$jk', tmp_lahir='$tmp_lahir',
            tgl_lahir='$tgl_lahir', alamat_asal='$alamat_asal', 
            alamat_jogja='$alamat_jogja', asal_kampus='$asal_kampus', 
            angkatan='$angkatan', telpon='$telpon', foto = '$foto', id ='$user_terlogin', kd_jabatan='$kd_jabatan'
            WHERE nia = $nia";

  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

//cek cookie
function cekCokie() {
  if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
  
    //ambil email berdasarkan id
    $result = mysqli_query($koneksi, "SELECT * FROM login WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
  
    //cek cookie dan nama
    if ($key === hash('sha256', $row['email'])) {
      if($row['id'] == '2') {
        $_SESSION['user'] = $row['id'];
      } else {
        $_SESSION['admin'] = $row['id'];
      }   
    }
  }
}

//cek login
function cekLogin(){
  if(isset($_SESSION["admin"]) || isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
  }

}


?>