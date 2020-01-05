<?php

session_start();
require_once 'koneksi.php';
require 'function.php';

//ambil data dari tabel anggota
$anggota = query("SELECT * FROM anggota");

//cek apakah tombol daftar sudah ditekan
if(isset($_GET["aksi"])) {
    switch($_GET['aksi']) {
        case "ubah":
            $kd_anggota2 = $_GET['kd_anggota'];
            
        break;
        case "hapus":
            $kd_anggota = $_GET['kd_anggota'];
            $sql_hapus = "DELETE FROM anggota WHERE kd_anggota = '$kd_anggota'";
            hapus($sql_hapus);
            header("Location: olah_data_anggota.php");
        break;
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
                <li><a href="listings.php"><span>Listings</span></a></li>
                <li><a href="about.php"><span>About</span></a></li>
                <li><a href="blog.php"><span>Blog</span></a></li>
                <?php if((@$_SESSION["admin"])) : ?>     
                <li class="has-children active">
                  <a href="#"><span>Olah Data</span></a>
                  <ul class="dropdown arrow-top">
                    <li><a href="olah_data_anggota.php">Anggota</a></li>
                  </ul>
                </li>
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

  

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>Selamat Datang Admin</h1>
                <p data-aos="fade-up" data-aos-delay="100">Halaman ini digunakan untuk mengolah data anggota KAMABA Yogyakarta</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container" style="margin-top: -150px;">
      <div class="row ">
        <div class="col p-3 bg-white">
        <h3>Daftar Anggota</h3>
                    
        <div class="table-responsive p-3 bg-white"  style="font-size: 11px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Alamat Asal</th>
                    <th scope="col">Alamat Jogjakarta</th>
                    <th scope="col">Asal Kampus</th>
                    <th scope="col">Angkatan</th>
                    <th scope="col">Nomor Telpon</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($anggota as $row) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><img src="images/user/<?= $row["foto"] ?>" alt="user" width="40px"></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["jk"] ?></td>
                    <td><?= $row["tempat_lahir"] ?></td>
                    <td><?= $row["tanggal_lahir"] ?></td>
                    <td><?= $row["alamat_asal"] ?></td>
                    <td><?= $row["alamat_yk"] ?></td>
                    <td><?= $row["asal_kampus"] ?></td>
                    <td><?= $row["angkatan"] ?></td>
                    <td><?= $row["telp"] ?></td>
                    <td>
                        <a href="olah_data_anggota.php?aksi=ubah&kd_anggota=<?= $row["kd_anggota"]; ?> data-toggle="modal" data-target="#editAnggota">
                            ubah
                    </a> |
                        <a href="olah_data_anggota.php?aksi=hapus&kd_anggota=<?= $row["kd_anggota"]; ?>">hapus</a>
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
        </div>
      </div>
    </div>
    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-12 text-md-center text-left">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
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

<!-- Modal -->
<div class="modal fade" id="editAnggota" tabindex="-1" role="dialog" aria-labelledby="judulEdit" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="judulEdit">Edit Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <?php 
            $result = mysqli_query($koneksi, "SELECT * FROM anggota WHERE kd_anggota='$kd_anggota2'");
            $data_user = mysqli_fetch_assoc($result);
        ?>
        <form action="" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="ex: Youse Nur" value="<?= $data_user["nama"]; ?>">
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="jk" id="jk" value="Laki-laki" checked>
            <label class="form-check-label" for="jk">
                Laki-laki
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="jk" id="jk" value="Perempuan">
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
        <div class="form-group">
            <label class="text-black" for="foto">Foto</label> 
            <input type="file" name="foto" id="foto" class="form-control">
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