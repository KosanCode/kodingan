<?php
  session_start();
  require 'functionkegiatan.php';

  if(isset($_SESSION["admin"]) || (!isset($_SESSION["user"]))){
    header("Location: index.php");
    exit;
}
  


  $kd_kegiatan = $_GET["kd_kegiatan"];

  $single_kegiatan = query("SELECT * FROM kegiatan WHERE kd_kegiatan = $kd_kegiatan ")[0];




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Browse &mdash; Website Template by Colorlib</title>
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
                <li ><a href="index.php"><span>Home</span></a></li>
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
                    <li><a href="profile.php">Profile</a></li>
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

  

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/kegiatan.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>KEGIATAN</h1>
                <h2 style="color: white;" class="mb-0"><?= $single_kegiatan["kegiatan"]; ?></h2>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">

            <div class="mb-5 border-bottom pb-5">

              <img src="images/kegiatan/<?= $single_kegiatan["gambar"]; ?>" alt="Image" class="img-fluid mb-4">
              <h1><?= $single_kegiatan["kegiatan"]; ?></h1>
              <p style="text-align: justify;"><?= $single_kegiatan["detail"]; ?></p>
              <h3 class="h5 text-black mb-3">KETERANGAN :</h3>
              <p><img src="images/date.jpg" width="20px" style="margin-right: 10px; padding-bottom: 5px;"><?= $format_tanggal = date('d F Y', strtotime($single_kegiatan["tanggal"])); ?></p>
              <p><img src="images/location.png" width="20px" style="margin-right: 10px; padding-bottom: 5px;"><?= $single_kegiatan["tempat"]; ?></p>
              <p><img src="images/uang2.png" width="20px" style="margin-right: 10px; padding-bottom: 5px;">Rp <?= $single_kegiatan["iuran"]; ?></p> 


              <div class="row" style="text-align: right;">
                <div class="col-md-12"  >
                  <br><br>
                  <a href="pendaftarankeg.php?kd_kegiatan=<?= $single_kegiatan["kd_kegiatan"]; ?>" class="btn btn-primary btn-md text-white">DAFTAR</a>
                </div>

              </div>

            </div>

            <!--

            <h2 class="mb-5 text-primary">More Listings</h2>

            <?php
              $i=1;

               foreach ($kegiatan as $row):
            ?>
            <div class="d-block d-md-flex listing-horizontal">

              <a href="#" class="img d-block" style="background-image: url(images/<?= $row["gambar"]; ?>)"></a>

              <div class="lh-content">
                <a href="listings-single.php" class="bookmark"><span class="icon-heart"></span></a>
                <h3><a href="listings-single.php"> <?= $row["kegiatan"]; ?></a></h3>
                <p>
                  <img src="images/date.jpg" width="20px" style="margin-right: 10px; padding-bottom: 5px;">
                  <?= 
                      $format_tanggal = date('d F Y', strtotime($row["tanggal"]));
                  ?>
              </p>
                <p><img src="images/location.png" width="20px" style="margin-right: 10px; padding-bottom: 5px;"><?= $row["tempat"]; ?></p>              </div>

            </div>
            <?php 
              $i++;
            endforeach;
            ?>
            
        
            <div class="col-12 mt-5 text-center">
              <div class="custom-pagination">
                <?php 
                    for($j=1; $j<=$pages; $j++){ ?>

                      <a href="?halaman=<?php echo $j ?>"><?php echo $j ?></a>
                <?php
                    }
                ?>
              </div>
            </div>

          </div> -->
       <!-- <div class="col-lg-3 ml-auto">

            <div class="mb-5">
              <h3 class="h5 text-black mb-3">MORE KEGIATAN</h3>
              
          </div> --> 
            
            

            

          </div> 

        </div>
      </div>
    </div>

    
   <!-- <div class="py-5 bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mr-auto mb-4 mb-lg-0">
            <h2 class="mb-3 mt-0 text-white">Let's get started. Create your account</h2>
            <p class="mb-0 text-white">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
          <div class="col-lg-4">
            <p class="mb-0"><a href="signup.php" class="btn btn-outline-white text-white btn-md px-5 font-weight-bold btn-md-block">Sign Up</a></p>
          </div>
        </div>
      </div>
    </div> -->
    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
          <!--   <div class="row">
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Products</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Features</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </div>
            </div> -->
          </div>
          <div class="col-lg-3">
          <!--   <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <form action="#" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-white" type="button" id="button-addon2">Send</button>
                </div>
              </div>
            </form>
          </div> -->
        </div>
        <div class="col-md-12">
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