<?php

session_start();
require_once '../koneksi.php';
require '../function.php';

//ambil data dari tabel anggota
$kd_anggota = $_GET['kd_anggota'];
$anggota = query("SELECT * FROM anggota a JOIN jabatan j ON a.kd_jabatan=j.kd_jabatan WHERE kd_anggota = $kd_anggota")[0];

$jabatan = mysqli_query($koneksi, "SELECT * FROM jabatan");

//cek apakah tombol ubah jabatan sudah ditekan
if(isset($_POST["ubahJabatan"])) {
  if( updateJabatan($_POST) > 0){
      echo "
              <script>
                  alert('Data Jabatan berhasil diubah!');
                  document.location.href = 'data_anggota.php';
              </script>
      ";
  } else {
      echo "
              <script>
                  alert('Data gagal diubah!');
                  document.location.href = 'data_anggota.php';
              </script>
      ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Kamaba - Administrator Page</title>

  <!-- Favicons -->
  <!-- <link href="img/favicon.png" rel="icon"> -->
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>KAMA<span>BA</span></b></a>
      <!--logo end-->
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="../logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><img src="img/admin.png" class="img-circle" width="80"></p>
          <h5 class="centered">ADMIN</h5>
          <li class="mt">
            <a href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          <li class="sub-menu">
          <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Data</span>
              </a>
              <ul class="sub">
              <li class="active"><a href="data_anggota.php">Anggota</a></li>
              <li><a  href="dokumen_bEnd.php">Sertifikat</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside><!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Data Anggota KAMABA</h3>
        
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt form-panel">
          <div class="col-lg-12">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Biodata Lengkap</h4>
            <form class="form-horizontal style-form" method="POST">
              <div class="col-lg-6">
                  <?php  ?>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Kode Anggota</label>
                    <div class="col-sm-8">
                      <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["kd_anggota"]; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["nama"]; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                      <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["jk"]; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tempat Lahir</label>
                    <div class="col-sm-8">
                      <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["tempat_lahir"]; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tanggal Lahir</label>
                    <div class="col-sm-8">
                      <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["tanggal_lahir"]; ?>" disabled>
                    </div>
                  </div>
                  
              </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="col-sm-4 control-label">Alamat Asal</label>
                <div class="col-sm-8">
                  <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["alamat_asal"]; ?>" disabled>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-4 control-label">Alamat Yogyakarta</label>
                <div class="col-sm-8">
                  <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["alamat_yk"]; ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Asal Kampus</label>
                <div class="col-sm-8">
                  <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["asal_kampus"]; ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Angkatan</label>
                <div class="col-sm-8">
                  <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["angkatan"]; ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Nomor Telpon</label>
                <div class="col-sm-8">
                  <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["telp"]; ?>" disabled>
                </div>
              </div>
            </div>
            </form>
          </div>
          <!-- col-lg-12-->
        </div>


        <div class="row mt form-panel">
          <div class="col-lg-12">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Jabatan Saat Ini</h4>
            <form class="form-horizontal style-form" method="POST">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="col-sm-4 control-label">Kode Jabatan</label>
                  <div class="col-sm-8">
                    <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["kd_jabatan"]; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="col-sm-4 control-label">Jabatan</label>
                  <div class="col-sm-8">
                    <input class="form-control" id="disabledInput" type="text" value="<?= $anggota["jabatan"]; ?>" disabled>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 text-center">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editJabatan">
                  Ubah Jabatan
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="advanced_table.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <!--script for this page-->
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <!--custom switch-->
  <script src="lib/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="lib/jquery.tagsinput.js"></script>
  <!--custom checkbox & radio-->
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="lib/form-component.js"></script>
</body>

</html>

<!-- Modal -->
<div class="modal fade" id="editJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Jabatan Member KAMABA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
          <label for="kd_jabatan">Jabatan</label>
          <select class="form-control" name="kd_jabatan" id="kd_jabatan">
            <?php while($data = mysqli_fetch_assoc($jabatan) ){?>
              <option value="<?php echo $data['kd_jabatan']; ?>"><?php echo $data['jabatan']; ?></option>
            <?php } ?>
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="ubahJabatan" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
            