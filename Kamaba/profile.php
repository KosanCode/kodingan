<?php

session_start();
require_once 'koneksi.php';
require 'function.php';

//cek session login
if(isset($_SESSION["admin"]) || (!isset($_SESSION["user"]))){
    header("Location: index.php");
    exit;
}

//ambil data dari tabel anggota sesuai user login
$user_terlogin = @$_SESSION['user'];

$result = mysqli_query($koneksi, "SELECT * FROM anggota INNER JOIN jabatan ON anggota.kd_jabatan=jabatan.kd_jabatan 
                              INNER JOIN login ON anggota.id=login.id WHERE login.id = '$user_terlogin'") or die(mysqli_error($koneksi));

$result2 = mysqli_query($koneksi, "SELECT * FROM login WHERE id='$user_terlogin'") or die(mysqli_error($koneksi));

//cek apakah tombol edit sudah ditekan
if(isset($_POST["update"])) {
  if( updateProfile($_POST) > 0){
      echo "
              <script>
                  alert('Data anda berhasil diubah!');
                  document.location.href = 'profile.php';
              </script>
      ";
  } else {
      echo "
              <script>
                  alert('Data gagal diubah!');
                  document.location.href = 'profile.php';
              </script>
      ";
  }
}

//cek apakah tombol edit sudah ditekan
if(isset($_POST["fotoProfile"])) {
  if( updateFoto($_POST) > 0){
      echo "
              <script>
                  alert('Foto profile anda berhasil diubah!');
                  document.location.href = 'profile.php';
              </script>
      ";
  } else {
      echo "
              <script>
                  alert('Foto profile gagal diubah!');
                  document.location.href = 'profile.php';
              </script>
      ";
  }
}

//cek apakah tombol edit sudah ditekan
if(isset($_POST["ubahPassword"])) {
  if( updatePassword($_POST) > 0){
      echo "
              <script>
                  alert('Password anda berhasil diubah! Silahkan login kembali');
                  document.location.href = 'logout.php';
              </script>
      ";
  } else {
      echo "
              <script>
                  alert('Password gagal diubah!');
                  document.location.href = 'profile.php';
              </script>
      ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Kamaba &mdash; Yogyakarta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/rangeslider.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleku.css">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-11 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="index.php" class="text-white h2 mb-0">KAMABA</a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.php"><span>Home</span></a></li>
                <?php if(@$_SESSION["user"]) : ?>
                <li class="has-children">
                  <a href="listings.php"><span>Kegiatan</span></a>
                  <ul class="dropdown arrow-top">
                    <li><a href="listings.php">Daftar Kegiatan</a></li>
                    <li><a href="sertifikat.php">Sertifikat</a></li>
                    <!--<li class="has-children">
                      <a href="#">Dropdown</a>
                      <ul class="dropdown">
                        <li><a href="#">Menu One</a></li>
                        <li><a href="#">Menu Two</a></li>
                        <li><a href="#">Menu Three</a></li>
                        <li><a href="#">Menu Four</a></li>
                      </ul>
                    </li>-->
                  </ul>
                </li>
                <?php endif; ?>
                <li><a href="struktur.php"><span>Kepengurusan</span></a></li>
                <li><a href="about.php"><span>Info</span></a></li>
                <li><a href="blog.php"><span>Blog</span></a></li>
                <?php if(@$_SESSION["user"]) : ?>                
                  <li class="has-children activeku">
                  <?php
                    $user_terlogin = @$_SESSION['user'];
                    $sql_user = mysqli_query($koneksi, "SELECT * FROM login WHERE id = '$user_terlogin'") or die(mysql_error());
                    $data_user =  mysqli_fetch_array($sql_user);
                  ?>
                  <a href="#"><span><?php echo $data_user['nama_lengkap']; ?> </span></a>
                  
                  <ul class="dropdown arrow-top">
                    <li><a href="#">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    </li>
                  </ul>
                </li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>
      
    </header>

  

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>My Dashboard</h1>
                <p data-aos="fade-up" data-aos-delay="100">Anda merupakan anggota KAMABA, junjung tinggi solidaritas dan jaga nama baik keluarga..</p>
              </div>
            </div>          
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        
        <div class="row">
          <?php  
            $user_terlogin = @$_SESSION['user'];
            $sql_user = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = '$user_terlogin'") or die(mysql_error());
            $data_user =  mysqli_fetch_array($sql_user);

            if(@$_SESSION["user"] && @$data_user['id']) {
          ?>
          <div class="col-md-12 p-5 bg-white" style="margin-top: -150px;">
            <div class="row mb-5">
                <div class="col-md-4 text-left border-primary">
                    <!-- Button trigger modal -->
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#editProfile">
                        <img src="images/edit.png" alt="edit.png" width="20px">
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="judulEdit" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="judulEdit">Edit Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                          <form action="" method="POST">
                            <div class="form-group">
                              <label for="nama">Nama Lengkap</label>
                              <input type="text" class="form-control" id="nama" name="nama" placeholder="ex: Youse Nur" value="<?= $data_user["nama"]; ?>">
                            </div>
                            <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="jk" value="laki-laki" checked>
                                <label class="form-check-label" for="jk">
                                  Laki-laki
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="jk" value="perempuan">
                                <label class="form-check-label" for="jk">
                                  Perempuan
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="tempat_lahir">Tempat Lahir</label>
                              <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $data_user["tempat_lahir"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="tanggal_lahir">Tanggal Lahir</label>
                              <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $data_user["tanggal_lahir"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="alamat_asal">Alamat Asal</label>
                              <input type="text" class="form-control" id="alamat_asal" name="alamat_asal" rows="3" placeholder="Isikan alamat lengkapmu di Blora" value="<?= $data_user["alamat_asal"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="alamat_yk">Alamat Jogja</label>
                              <input type="text" class="form-control" id="alamat_yk" name="alamat_yk" rows="3" placeholder="Isikan alamat lengkapmu di Yogyakarta" value="<?= $data_user["alamat_yk"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="asal_kampus">Asal Kampus</label>
                              <input type="text" class="form-control" id="asal_kampus" name="asal_kampus" placeholder="Tempat kamu kuliah" value="<?= $data_user["asal_kampus"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="angkatan">Angkatan</label>
                              <input type="number" class="form-control" id="angkatan" name="angkatan" placeholder="ex: 2017" value="<?= $data_user["angkatan"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="telp">Nomor Telpon</label>
                              <input type="number" class="form-control" id="telp" name="telp" placeholder="ex: 0852xxxx" value="<?= $data_user["telp"]; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    <h2 class="font-weight-light text-primary">Biodata Diri</h2>
                </div>
            </div>
            
            <?php $row = mysqli_fetch_assoc($result) ?>
            <div class="row">
                <div class="col-md-6 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <img src="images\user\<?= $row["foto"]; ?>" width="250px" height="250px" style="border-radius: 50%">
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12 p-3">
                      <!-- Button trigger modal -->
                      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#editFotoProfile">
                          Ubah Foto Profile
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="editFotoProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Ubah Foto Profile</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                              <div class="modal-body text-left">
                                  <label for="foto">Pilih foto baru</label>
                                  <input type="file" class="form-control" name="foto" id="foto">
                                  <small>max file: 500kb</small>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="fotoProfile" class="btn btn-primary">Ubah Foto</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6 text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="font-weight-bold">Kode Anggota</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["kd_anggota"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Nama Lengkap</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["nama"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Jenis Kelamin</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["jk"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Tempat Lahir</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["tempat_lahir"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Tanggal Lahir</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["tanggal_lahir"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Alamat Asal</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["alamat_asal"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Alamat Jogja</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["alamat_yk"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Asal Kampus</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["asal_kampus"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Angkatan</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["angkatan"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Nomor Telpon</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["telp"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Jabatan</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= $row["jabatan"]; ?></p>
                        </div>
                    </div>
                </div>                
              </div>            
            </div>         
        <?php } ?>
        <div class="col-md-12 p-5 bg-white" style="margin-top:-150px;">
          <div class="row mb-5">
            <div class="col-md-4 text-left border-primary">
              <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#editPassword">
                    <img src="images/edit.png" alt="edit.png" width="20px">
                </button>
                <!-- Modal -->
                <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="judulUpdate" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judulUpdate">Ubah Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <label for="passLama">Password Lama</label>
                        <input type="password" class="form-control" name="passLama" id="passLama" placeholder="Password Lama">
                      </div>
                      <div class="form-group">
                        <label for="passBaru1">Password Baru</label>
                        <input type="password" class="form-control" name="passBaru1" id="passBaru1" placeholder="Password Baru">
                      </div>
                      <div class="form-group">
                        <label for="passBary2">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="passBaru2" id="passBaru2" placeholder="Konfirmasi Password Baru">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="ubahPassword" class="btn btn-primary">Update</button>
                    </div>
                    </div>
                    </form>
                </div>
                </div>
                <h2 class="font-weight-light text-primary">Kelola User Login</h2>
            </div>  
          </div>

          <?php $row2 = mysqli_fetch_assoc($result2) ?>
          <div class="row">
            <div class="col-md-6 text-left">
              <div class="row">
                  <div class="col-md-6">
                      <p class="font-weight-bold">Email</p>
                  </div>
                  <div class="col-md-6">
                      <p><?= $row2["email"]; ?></p>
                  </div>
                  </div>
              </div>
          </div>
        </div>  
      </div>
      </div>
    </div>
    
    <footer>
      <div class="container">

        
          <div class="col-lg-12" style="margin-top: 20px;">
            <div class="row"> 
              <div class="col-lg-5">
                  <a href="about.php" class="logo"><h1 style="color: #000;"><b>KAMA<span style="color: #00908d;">BA</span></b></h1></a>
                  <p>Keluarga Mahasiswa Blora (KAMABA) Yogyakarta merupakan organisasi mahasiswa di Yogyakarta<br> yang berasal dari daerah Kabupaten Blora,<br> Provinsi Jawa Tegah.
                    
                  </p>
              </div>

              <div class="col-lg-4">
                  <div class="row">
                    <i class="icon-map-marker" style="font-size: 24px; margin-right: 30px;"></i>
                    <p >Jaranan, Desa Banguntapan, <br> Kec. Banguntapan, Kab.  Bantul,<br> Daerah Istimewa Yogyakarta<br> 55198
                    </p>
                  </div>
                  <div class="row">
                    <i class="icon-camera-retro" style="font-size: 24px; margin-right: 20px;"></i>
                    <p >kamaba_yk</p>
                  </div>
                  <div class="row">
                    <i class="icon-envelope" style="font-size: 24px; margin-right: 20px;"></i>
                    <p >kamaba_yk@gmail.com</p>
                  </div>
              </div>

              <div class="col-lg-3">
              <a href="about.php"><img class="col-lg-12" src="images/logo.png"></a>
              </div>
            </div>
          </div>
       
        
          <div class="text-center p-3">

            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a> x KosanCode <img src="images/kosanlogo.png" height="25px">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            
          </div>
        
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/rangeslider.min.js"></script>
  
  <script src="js/main.js"></script>
  
  </body>
</html>