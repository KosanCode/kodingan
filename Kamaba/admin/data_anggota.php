<?php

session_start();
require_once '../koneksi.php';
require '../function.php';

//cek session login
if(isset($_SESSION["user"])){
  header("Location: ../index.php");
  exit;
}

//cek session login
if(!isset($_SESSION["admin"])){
header("Location: ../signup.php");
exit;
}

//ambil data dari tabel anggota
$anggota = query("SELECT * FROM anggota a JOIN jabatan j ON a.kd_jabatan=j.kd_jabatan");

//cek apakah tombol daftar sudah ditekan
if(isset($_GET["aksi"])) {
    switch($_GET['aksi']) {
        case "ubah":
            
        break;
        case "hapus":
            $kd_anggota = $_GET['kd_anggota'];
            $sql_hapus = "DELETE FROM anggota WHERE kd_anggota = '$kd_anggota'";
            $result = mysqli_query($koneksi, $sql_hapus);
            // $row = mysqli_fetch_assoc($result);
            echo "
              <script>
                  alert('Data berhasil dihapus!');
                  document.location.href = 'data_anggota.php';
              </script>
            ";
        break;
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
  <link href="lib/fancybox/jquery.fancybox.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/jquery/jquery.min.js"></script>


  
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
          <li class="sub-menu">
            <a href="data_kegiatan.php">
              <i class="fa fa-th"></i>
              <span>Kegiatan</span>
              </a>
          </li>
		  <li class="sub-menu">
            <a href="data_berita.php">
              <i class="fa fa-th"></i>
              <span>Berita</span>
              </a>
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
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table table-responsive">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
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
                    <th scope="col">Jabatan</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                    <?php foreach($anggota as $row) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td>
                    <div class="project-wrapper">
                        <div class="project">
                            <div class="photo">
                                <a class="fancybox" href="../images/user/<?= $row["foto"] ?>">
                                    <img src="../images/user/<?= $row["foto"] ?>" alt="user" width="40px">
                                </a>
                            </div>
                        </div>
                    </div>
                    </td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["jk"] ?></td>
                    <td><?= $row["tempat_lahir"] ?></td>
                    <td><?= $row["tanggal_lahir"] ?></td>
                    <td><?= $row["alamat_asal"] ?></td>
                    <td><?= $row["alamat_yk"] ?></td>
                    <td><?= $row["asal_kampus"] ?></td>
                    <td><?= $row["angkatan"] ?></td>
                    <td><?= $row["telp"] ?></td>
                    <td><?= $row["jabatan"] ?></td>
                    <td>
                        <a href="edit_anggota.php?aksi=ubah&kd_anggota=<?= $row["kd_anggota"]; ?>">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                        </a>
                        <a href="data_anggota.php?aksi=hapus&kd_anggota=<?= $row["kd_anggota"]; ?>" onclick="return confirm('Yakin ingin menghapus data yang dipilih?');">
                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </a>
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
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
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <script src="lib/fancybox/jquery.fancybox.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    // /* Formating function for row details */
    // function fnFormatDetails(oTable, nTr) {
    //   var aData = oTable.fnGetData(nTr);
    //   var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    //   sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
    //   sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    //   sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    //   sOut += '</table>';

    //   return sOut;
    // }

    $(document).ready(function() {
    //   /*
    //    * Insert a 'details' column to the table
    //    */
    //   var nCloneTh = document.createElement('th');
    //   var nCloneTd = document.createElement('td');
    //   nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
    //   nCloneTd.className = "center";

    //   $('#hidden-table-info thead tr').each(function() {
    //     this.insertBefore(nCloneTh, this.childNodes[0]);
    //   });

    //   $('#hidden-table-info tbody tr').each(function() {
    //     this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
    //   });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
    //   $('#hidden-table-info tbody td img').live('click', function() {
    //     var nTr = $(this).parents('tr')[0];
    //     if (oTable.fnIsOpen(nTr)) {
    //       /* This row is already open - close it */
    //       this.src = "lib/advanced-datatable/media/images/details_open.png";
    //       oTable.fnClose(nTr);
    //     } else {
    //       /* Open this row */
    //       this.src = "lib/advanced-datatable/images/details_close.png";
    //       oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
    //     }
    //   });
    
    });

    $(function() {
      //    fancybox
      jQuery(".fancybox").fancybox();
    });
  </script>
</body>

</html>
