<?php
session_start();
require 'koneksi.php';
require 'function.php';

//cek cookie
cekCokie();

//cek session login
cekLogin();


//registrasi
if(isset($_POST["register"])) {
  if( registrasi($_POST) > 0 ) {
    echo "<script>
            alert('User baru berhasil ditambahkan! Silahkan Login');
          </script>";
  } else {
    echo mysqli_error($koneksi);
  }
}


//login
if(isset($_POST["login"])){

  $email2 = $_POST["email2"];
  $pass3 = $_POST["pass3"];
  $login = $_POST["login"];
  
  if($login) {
    if($email2 == "" || $pass3 == "") {
      echo "<script>
              alert('Email / Password tidak boleh kosong!');
            </script>";
    }
  }
  $result = mysqli_query($koneksi, "SELECT * FROM login WHERE email = '$email2'");
  //cek email
  if(mysqli_num_rows($result) === 1) {
    //cek password
    $row = mysqli_fetch_assoc($result);
    if(password_verify($pass3, $row["password"])) {
      if($row['level'] === "admin") {
        //set session
        $_SESSION["admin"] = $row['id'];

        //cek remember me
        if(isset($_POST['remember'])) {
          //buat cookie
          setcookie('id',   $row['id'], time()+3600);
          setcookie('key', hash('sha256',$row['email']), time()+3600);
        } 
        header("Location: admin/index.php");
       } else if($row['level'] === "user") {
        //set session
        $_SESSION["user"] = $row['id'];

        //cek remember me
        if(isset($_POST['remember'])) {
          //buat cookie
          setcookie('id',  $row['id'], time()+3600);
          setcookie('key', hash('sha256', $row['email']), time()+3600);
        }
        header("Location: index.php");
      }
      
      exit;
    }
  }

  $error = true;
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
                <li><a href="struktur.php"><span>Kepengurusan</span></a></li>
                <li><a href="about.php"><span>Info</span></a></li>
                <li><a href="blog.php"><span>Blog</span></a></li>
                <li class="active"><a href="signup.php"><span>Login</span></a></li>
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
                <h1>Sign Up / Sign In</h1>
                <p data-aos="fade-up" data-aos-delay="100">Silahkan Register apabila anda belum memiliki akun. Apabila sudah ada mempunyai akun langsung Login aja lur..</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5">

            

            <form action="" method="POST" class="p-5 bg-white" style="margin-top: -150px;">
             
              <h3 class="text-center pb-4">Sign Up</h3>            

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="fname">Full Name</label>
                  <input type="text" name="name" id="name" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" name="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="pass1">Password</label> 
                  <input type="password" name="password" id="pass1" class="form-control">
                </div>
              </div>
              
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="pass2">Re-type Password</label> 
                  <input type="password" name="pass2" id="pass2" class="form-control">
                </div>
              </div>
              

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="register" value="Sign Up" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-6 mb-5">

            <form action="" method="POST" class="p-5 bg-white" style="margin-top: -150px;">
             
              <h3 class="text-center pb-4">Sign In</h3>            

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" name="email2" id="email2" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="pass1">Password</label> 
                  <input type="password" name="pass3" id="pass3" class="form-control">
                </div>
              </div>
              
              <div class="row">
                
                <div class="col-md-12">
                  <input type="checkbox" name="remember" id="remember" >
                  <label class="text-black" for="remember">Remember Me</label> 
                </div>
              </div>
              

              <div class="row form-group">
                
                <div class="col-md-12">
                  <?php if(isset($error)) :  ?>
                    <p style="color: red; font-style: italic">Email / Password salah</p>
                  <?php endif; ?>              
                </div>
              </div>

              

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="login" value="Log In" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
            <?php
            
            ?>
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