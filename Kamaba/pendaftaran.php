<?php
session_start();
require_once 'koneksi.php';
require 'function.php';

//cek session login
if(!isset($_SESSION["user"])){
    header("Location: signup.php");
    exit;
}

//cek session login
if(isset($_SESSION["admin"])){
  header("Location: index.php");
  exit;
}

if(isset($_SESSION["user"])) {
    $user_terlogin = @$_SESSION['user'];
    $sql_user = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = '$user_terlogin'") or die(mysql_error());
    $data_user =  mysqli_fetch_array($sql_user);

    if(@$data_user['id']) {
        header("Location: index.php");
        exit;
    }
}
//cek apakah tombol daftar sudah ditekan
if(isset($_POST["daftar"])) {
    if( pendaftaran($_POST) > 0){
        echo "
                <script>
                    alert('Anda telah menjadi anggota KAMABA!');
                    document.location.href = 'profile.php';
                </script>
        ";
    } else {
        echo "
                <script>
                    alert('DATA GAGAL DITAMBAHKAN!');
                    document.location.href = 'pendaftaran.php';
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

                <?php if((@!$_SESSION["admin"]) && (@!$_SESSION["user"])) : ?>
                <li class="activeku"><a href="signup.php"><span>Login</span></a></li>
                <?php endif; ?>
                <?php  
                  $user_terlogin = @$_SESSION['user'];
                  $sql_user = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = '$user_terlogin'") or die(mysql_error());
                  $data_user =  mysqli_fetch_array($sql_user);

                  if(@$_SESSION["user"] && !@$data_user['id']) :
                ?>
                  <li><a href="pendaftaran.php"><span style="border: 2px solid #fff;">Join With Us</span></a></li>
                <?php endif; ?>
                <?php if(@$_SESSION["admin"] || @$_SESSION["user"]) : ?>                
                  <li class="has-children activeku">
                  <?php 
                    if(@$_SESSION["admin"]) {
                      $user_terlogin = @$_SESSION['admin'];
                    } else if(@$_SESSION["user"]){
                      $user_terlogin = @$_SESSION['user'];
                    }
                    $sql_user = mysqli_query($koneksi, "SELECT * FROM login WHERE id = '$user_terlogin'") or die(mysql_error());
                    $data_user =  mysqli_fetch_array($sql_user);
                  ?>
                  <a href="#"><span><?php echo $data_user['nama_lengkap']; ?> </span></a>
                  
                  <ul class="dropdown arrow-top">
                  <?php
                  if(@$_SESSION["user"]) :?>
                    <li><a href="profile.php">Profile</a></li>
                  <?php endif; ?>
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
                <h1>Pendaftaran Anggota</h1>
                <p data-aos="fade-up" data-aos-delay="100">Asal kamu dari Blora dan lagi kuliah di Yogyakarta? Ayo gabung di KAMABA (Keluarga Mahasiswa Blora)</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12">

            

            <form action="" method="POST" class="p-5 bg-white" style="margin-top: -150px;" enctype="multipart/form-data">
             

              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="nama">Nama Lengkap</label>
                  <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="email">Jenis Kelamin</label> <br>
                  <div class="col-md-6">
                    <input type="radio" name="jk" value="Laki-laki" id="jk" checked="true">Laki-laki
                  </div>
                  <div class="col-md-6">
                    <input type="radio" name="jk" value="Perempuan" id="jk">Perempuan
                  </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="tempat_lahir">Tempat Lahir</label> 
                  <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="tanggal_lahir">Tanggal Lahir</label> 
                  <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="alamat_asal">Alamat Asal</label> 
                  <textarea name="alamat_asal" id="alamat_asal" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="alamat_yk">Alamat Jogja</label> 
                  <textarea name="alamat_yk" id="alamat_yk" cols="30" rows="5" class="form-control" required></textarea>
                </div>
              </div>
              
              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="asal_kampus">Asal Kampus</label> 
                  <input type="text" name="asal_kampus" id="asal_kampus" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="angkatan">Angkatan</label> 
                  <input type="number" name="angkatan" id="angkatan" class="form-control" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="telp">Nomor Telpon</label> 
                  <input type="number" name="telp" id="telp" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="foto">Foto</label> 
                  <input type="file" name="foto" id="foto" class="form-control">
                  <small>max file: 500kb</small>
                </div>
              </div>
            
              <div class="row justify-content-center form-group">
                <div class="col-md-8 text-center">
                  <button type="submit" name="daftar" class="btn btn-primary btn-md text-white">Daftar</button>
                  <button type="reset" name="reset" class="btn btn-primary btn-md text-white">Reset</button>
                </div>
              </div>

  
            </form>
          </div>
          
        </div>
      </div>
    </div>
    
    <footer>
      <div class="container" style="padding-top: 20px; padding-bottom: 20px;">

        
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
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a><br> KosanCode <br> <img src="images/kosanlogo.png" height="25px">
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