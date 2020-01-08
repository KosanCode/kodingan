<?php
  session_start();
  require_once 'koneksi.php';
  require_once 'function.php';

  $kegiatan = query("SELECT * FROM kegiatan ORDER BY tanggal DESC LIMIT 0, 6");
  $berita = query("SELECT * FROM tabelberita ORDER BY tanggal DESC LIMIT 0, 3");

  $dtl_kegiatan = query("SELECT * FROM dtl_kegiatan");

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
                <li class="active"><a href="index.php"><span>Home</span></a></li>

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

  

    <div class="site-blocks-cover overlay" style="background-image: url(images/hero.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10">
            
            
            <div class="row justify-content-center mb-4">
              <div class="col-md-10 text-center">
                <h1 data-aos="fade-up">Find New <span class="typed-words"></span></h1>
                <p data-aos="fade-up" class=" w-75 mx-auto">With Us</br>"Keluarga Mahasiswa Blora (KAMABA) Yogyakarta"</p>
              </div>
            </div>

            <div class="form-search-wrap p-2" data-aos="fade-up" data-aos-delay="200">
              <form method="post">
                <div class="row align-items-center">
                  <div class="col-lg-12 col-xl-10 no-sm-border border-right">
                    <input type="text" class="form-control" placeholder="What are you looking for?">
                  </div>
                  <!--
                  <div class="col-lg-12 col-xl-3">
                    <div class="select-wrap">
                      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                      <select class="form-control" name="" id="">
                        <option value="">All Categories</option>
                        <option value="">Hotels</option>
                        <option value="">Restaurant</option>
                        <option value="">Eat &amp; Drink</option>
                        <option value="">Events</option>
                        <option value="">Fitness</option>
                        <option value="">Others</option>
                      </select>
                    </div>
                  </div>
				  -->
                  <div class="col-lg-12 col-xl-2 ml-auto text-right">
                    <input type="submit" class="btn text-white btn-primary" value="Search">
                  </div>
                  
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>  

    
    
      
    
    <div class="site-section" data-aos="fade">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Our Activities</h2>
            <p class="color-black-opacity-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>

        <div class="row">
		
			<?php
              $i=1;

               foreach ($kegiatan as $row):
            ?>
			
          <div class="col-md-6 mb-4 mb-lg-4 col-lg-4">
            

          
            <div href="listings-single.php?kd_kegiatan=<?= $row["kd_kegiatan"]; ?>" class="listing-item ">
              <div class="listing-image">
                <img style="height: 300px;" src="images/kegiatan/<?= $row["gambar"]; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
              </div>
              <div class="listing-item-content">
                <a href="listings-single.php?kd_kegiatan=<?= $row["kd_kegiatan"]; ?>" class="bookmark" data-toggle="tooltip" data-placement="left" title="Bookmark"><span class="icon-heart"></span></a>
                <a class="px-3 mb-3 category" href="#"><?= date('d F Y', strtotime($row["tanggal"])); ?></a>
                <h2 class="mb-1"><a href="listings-single.php?kd_kegiatan=<?= $row["kd_kegiatan"]; ?>"><?= $row["kegiatan"]; ?></a></h2>
                <span class="address"><?= $row["tempat"]; ?></span>
              </div>
            </div>
          </div>
		  
		  <?php 
              $i++;
            endforeach;
           ?>
			
		</div>
      </div>
    </div>

    <!--
    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Popular Categories</h2>
            <p class="color-black-opacity-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>

        <div class="row align-items-stretch">
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
            <a href="#" class="popular-category h-100">
              <span class="icon mb-3"><span class="flaticon-hotel"></span></span>
              <span class="caption mb-2 d-block">Hotels</span>
              <span class="number">4,89</span>
            </a>
          </div>
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
            <a href="#" class="popular-category h-100">
              <span class="icon mb-3"><span class="flaticon-microphone"></span></span>
              <span class="caption mb-2 d-block">Events</span>
              <span class="number">482</span>
            </a>
          </div>
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
            <a href="#" class="popular-category h-100">
              <span class="icon mb-3"><span class="flaticon-flower"></span></span>
              <span class="caption mb-2 d-block">Spa</span>
              <span class="number">194</span>
            </a>
          </div>
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
            <a href="#" class="popular-category h-100">
              <span class="icon mb-3"><span class="flaticon-restaurant"></span></span>
              <span class="caption mb-2 d-block">Stores</span>
              <span class="number">1,472</span>
            </a>
          </div>
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
            <a href="#" class="popular-category h-100">
              <span class="icon mb-3"><span class="flaticon-cutlery"></span></span>
              <span class="caption mb-2 d-block">Restaurants</span>
              <span class="number">439</span>
            </a>
          </div>
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
            <a href="#" class="popular-category h-100">
              <span class="icon mb-3"><span class="flaticon-bike"></span></span>
              <span class="caption mb-2 d-block">Other</span>
              <span class="number">692</span>
            </a>
          </div>
        </div>

        <div class="row mt-5 justify-content-center tex-center">
          <div class="col-md-4"><a href="#" class="btn btn-block btn-outline-primary btn-md px-5">View All Categories</a></div>
        </div>
      </div>
    </div>
    -->
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5">
            <img src="images/img_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid rounded">
          </div>
          <div class="col-md-5 ml-auto">
            <h2 class="text-primary mb-3">Q&A?</h2>
            <div class="row mt-4">
              <div class="col-12">
                <div class="border p-3 rounded mb-2">
                  <a data-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1" class="accordion-item h5 d-block mb-0">Apa itu KAMABA?</a>

                  <div class="collapse" id="collapse-1">
                    <div class="pt-2">
                      <p class="mb-0">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    </div>
                  </div>
                </div>

                <div class="border p-3 rounded mb-2">
                  <a data-toggle="collapse" href="#collapse-4" role="button" aria-expanded="false" aria-controls="collapse-4" class="accordion-item h5 d-block mb-0">Ngapain aja disini?</a>

                  <div class="collapse" id="collapse-4">
                    <div class="pt-2">
                      <p class="mb-0">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    </div>
                  </div>
                </div>

                <div class="border p-3 rounded mb-2">
                  <a data-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapse-2" class="accordion-item h5 d-block mb-0">Apa hanya ada di Yogyakarta?</a>

                  <div class="collapse" id="collapse-2">
                    <div class="pt-2">
                      <p class="mb-0">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                    </div>
                  </div>
                </div>

                <div class="border p-3 rounded mb-2">
                  <a data-toggle="collapse" href="#collapse-3" role="button" aria-expanded="false" aria-controls="collapse-3" class="accordion-item h5 d-block mb-0">Gimana cara joinnnya?</a>

                  <div class="collapse" id="collapse-3">
                    <div class="pt-2">
                      <p class="mb-0">The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">How It Works</h2>
            <p class="color-black-opacity-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
            <div class="how-it-work-step">
              <div class="img-wrap">
                <img src="images/step-1.svg" alt="Free website template by Free-Template.co" class="img-fluid">
              </div>
              <span class="number">1</span>
              <h3>Decide What To Do</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
          </div>
          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
            <div class="how-it-work-step">
              <div class="img-wrap">
                <img src="images/step-2.svg" alt="Free website template by Free-Template.co" class="img-fluid">
              </div>
              <span class="number">2</span>
              <h3>Find What You Want</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
          </div>
          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
            <div class="how-it-work-step">
              <div class="img-wrap">
                <img src="images/step-3.svg" alt="Free website template by Free-Template.co" class="img-fluid">
              </div>
              <span class="number">3</span>
              <h3>Join Ours Amazing Activities</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
	<!--
    <div class="site-section bg-light">
      <div class="container">

        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Satisfied Customers</h2>
          </div>
        </div>

        <div class="slide-one-item home-slider owl-carousel">
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_3_sq.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-3">
                <p>Willie Smith</p>
              </figure>
              <blockquote>
                <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
              </blockquote>
            </div>
          </div>
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_2_sq.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-3">
                <p>Robert Jones</p>
              </figure>
              <blockquote>
                <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
              </blockquote>
            </div>
          </div>

          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_4_sq.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-3">
                <p>Peter Richmond</p>
              </figure>
              <blockquote>
                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
              </blockquote>
            </div>
          </div>

          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_5_sq.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-3">
                <p>Bruce Rogers</p>
              </figure>
              <blockquote>
                <p>&ldquo;The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.&rdquo;</p>
              </blockquote>
            </div>
          </div>

        </div>
      </div>
    </div>
	-->


    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Tips &amp; Articles</h2>
            <p class="color-black-opacity-5">See Our Daily tips &amp; articles</p>
          </div>
        </div>
        <div class="row mb-3 align-items-stretch">
		<?php
              $i=1;

               foreach ($berita as $row):
        ?>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/img_<?= $i; ?>.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
              <div class="h-entry-inner">
                <h2 class="font-size-regular"><a href="#"><?= $row["judul"]; ?></a></h2>
                <div class="meta mb-4">by <a href="#"><?= $row["nama"]; ?></a> <span class="mx-2">&bullet;</span> <?= $row["tanggal"]; ?></div>
                <p style="overflow:hidden;"><?= $row["isi"]; ?></p>
              </div>
            </div> 
          </div>
		<?php 
              $i++;
            endforeach;
        ?>
		
		</div>
      </div>
    </div>

    
    <?php if((@!$_SESSION["admin"]) && (@!$_SESSION["user"])) { ?>
    <div class="py-5 bg-primary">
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
    </div>
    <?php } ?>
    
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
  

  <script src="js/typed.js"></script>
            <script>
            var typed = new Typed('.typed-words', {
            strings: [" Activities"," Friends"," Families", " Worlds"],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
            });
            </script>

  <script src="js/main.js"></script>
  
  </body>
</html>