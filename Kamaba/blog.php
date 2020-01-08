<?php
  session_start();
  include 'koneksi.php';
  
  
  $perhalaman = 4;
  $page = isset($_GET["perhalaman"]) ? (int)$_GET["perhalaman"] : 1;
  
  $start = ($page > 1) ? ($page * $perhalaman)- $perhalaman : 0;
  
  $berita = query("select * from tabelberita order by tanggal desc limit $start, $perhalaman");
  
  $hasil = mysqli_query($koneksi, "select * from tabelberita");
  $total = mysqli_num_rows($hasil);
  
  $pages = ceil($total/$perhalaman);
  
  //tombol cari
  if( isset( $_GET["cari"]) ) {
	  $berita = cari($_GET["keyword"]);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>KAMABA &mdash; Yogyakarta</title>
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
                <li class="active"><a href="blog.php"><span>Blog</span></a></li>

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

  

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/kegiatan.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>BERITA KAMABA</h1>
                <p data-aos="fade-up" data-aos-delay="100"></p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">

          <div class="col-md-8">
			
			<div class="row mb-3 align-items-stretch">

			<?php
				foreach($berita as $row):
				?>			
				<div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
					<div class="h-entry">
					<a href="blog-single.php?kd_berita=<?= $row["kd_berita"];?> "><img src="Images\Berita/<?=$row ["namagambar"]; ?>" alt="Image" class="img-fluid"></a>
						<div class="h-entry-inner">
							<h2 class="font-size-regular"><a href="blog-single.php?kd_berita=<?= $row["kd_berita"];?>"><?= $row["judul"]; ?></a></h2>
							<div class="meta mb-4">Oleh <?= $row["nama"]; ?> <span class="mx-2">&bullet;</span><?= $row["tanggal"]; ?></div>
							<p><?= substr($row["isi"], 0, 100); ?></p>
						</div>
					</div> 
				</div>	
            
			<?php
				endforeach;
				?>			
			</div>
            <div class="col-12 text-center mt-5">
				
              <p class="custom-pagination">
                <?php for ($i=1; $i<=$pages ; $i++){ ?>
					<a href="?perhalaman=<?php echo $i; ?>"><?php echo $i; ?></a>
				<?php } ?>
              </p>
            </div>
          </div>

          <div class="col-md-3 ml-auto">
            <div class="mb-5">
              <h3 class="h5 text-black mb-3">Search</h3>
              <form action="" method="get">
                <div class="form-group d-flex">
                  <input type="text" name="keyword" class="form-control" placeholder="Cari berita disini" autocomplete="off">
				  <button type="submit" name="cari">Cari</button>
                </div>
              </form>
            </div>

            <!--<div class="mb-5">
              <h3 class="h5 text-black mb-3">Popular Posts</h3>
              <ul class="list-unstyled">
                <li class="mb-2"><a href="#">Lorem ipsum dolor sit amet</a></li>
                <li class="mb-2"><a href="#">Quaerat rerum voluptatibus veritatis</a></li>
                <li class="mb-2"><a href="#">Maiores sapiente veritatis reprehenderit</a></li>
                <li class="mb-2"><a href="#">Natus eligendi nobis</a></li>
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 text-black mb-3">Recent Comments</h3>
              <ul class="list-unstyled">
                <li class="mb-2"><a href="#">Image</a> <em>in</em> <a href="#">Lorem ipsum dolor sit amet</a></li>
                <li class="mb-2"><a href="#">Image</a> <em>in</em> <a href="#">Quaerat rerum voluptatibus veritatis</a></li>
                <li class="mb-2"><a href="#">Image</a> <em>in</em> <a href="#">Maiores sapiente veritatis reprehenderit</a></li>
                <li class="mb-2"><a href="#">Image</a> <em>in</em> <a href="#">Natus eligendi nobis</a></li>
              </ul>
            </div>-->

          </div>
          
        </div>
      </div>
    </div>

    
    <!--<div class="py-5 bg-primary">
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
    </div>-->
    
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
        
          <div class="col-12 text-md-center text-left">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
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