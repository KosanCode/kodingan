<?php
  require '../koneksi.php';

  date_default_timezone_set("Asia/Jakarta");
  date_default_timezone_get();
  $now = date("Y-m-d H:i:s");
  
  $kegiatanku = query("SELECT * FROM dokumen INNER JOIN dtl_kegiatan ON dokumen.kd_anggota=dtl_kegiatan.kd_anggota AND dokumen.kd_kegiatan=dtl_kegiatan.kd_kegiatan INNER JOIN kegiatan ON kegiatan.kd_kegiatan=dokumen.kd_kegiatan INNER JOIN anggota ON anggota.kd_anggota=dokumen.kd_anggota ORDER BY tanggal_buat DESC");
  // var_dump($kegiatanku);

  $kehadiran = query("SELECT * FROM dtl_kegiatan JOIN kegiatan ON kegiatan.kd_kegiatan=dtl_kegiatan.kd_kegiatan JOIN anggota ON anggota.kd_anggota=dtl_kegiatan.kd_anggota ORDER BY tanggal");

  if(isset($_GET['aksi'])){

    $kd_kegiatan = $_GET["kd_kegiatan"];
    $kd_anggota = $_GET["kd_anggota"];

    switch($_GET['aksi']){

        case "hapus":
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM dokumen WHERE kd_dok=$id";
        update($sql_hapus);
        header('location: dokumen_bEnd.php');
        break;

        case "update":
        $sql_update = "UPDATE dtl_kegiatan SET status='y' WHERE kd_anggota='$kd_anggota' AND kd_kegiatan='$kd_kegiatan'";
        update($sql_update);
        header('location: dokumen_bEnd.php');
        break;

        case "simpan":

        $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dokumen WHERE kd_anggota='$kd_anggota' AND kd_kegiatan='$kd_kegiatan'"));

        $status = mysqli_query($koneksi,"SELECT status FROM dtl_kegiatan WHERE kd_anggota='$kd_anggota' AND kd_kegiatan='$kd_kegiatan'");


          if ($cek > 0){
          echo "<script>window.alert('Data tersebut sudah ada dalam database')
          window.location='dokumen_bEnd.php'</script>";
          }

          else if($status = 'n'){
          echo "<script>window.alert('Status peserta belum memenuhi syarat')
          window.location='dokumen_bEnd.php'</script>";
          }

          else {
          mysqli_query($koneksi, "INSERT INTO dokumen(kd_kegiatan, kd_anggota, tanggal_buat) VALUES ('$kd_kegiatan', '$kd_anggota', '$now') ");
 
          echo "<script>window.alert('Data telah disimpan')
          window.location='dokumen_bEnd.php'</script>";
          }
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
  <link href="./img/favicon.png" rel="icon">
  <link href="./img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="./lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="./lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="./lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="./lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="./lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="./css/style.css" rel="stylesheet">
  <link href="./css/style-responsive.css" rel="stylesheet">

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
          <li><a class="logout" href="login.html">Logout</a></li>
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
          <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">Sam Soffes</h5>
          <li class="mt">
            <a href="dokumen_bEnd.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          <li class="sub-menu">
            <a class="active" href="dokumen_bEnd.php">
              <i class="fa fa-th"></i>
              <span>Data Sertifikat</span>
              </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> List Sertifikat Tersimpan</h3>

        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kegiatan</th>
                    <th>Tgl. Kegiatan</th>
                    <th>Tgl. Buat</th>
                    <th class="center">Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                  $i=1;
                  foreach ($kegiatanku as $row):
                  ?>

                  <tr class="gradeA">
                    <th><?= $i; ?>.</th>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["kegiatan"]; ?></td>
                    <td><?= date('d F Y', strtotime($row["tanggal"])); ?></td>
                    <td><?= date('H:i:s - d F Y', strtotime($row["tanggal_buat"])); ?></td>
                    <td class="center">
                        <a href="../funcSertifikat.php?kd_kegiatan=<?= $row["kd_kegiatan"];?>&&kd_anggota=<?= $row["kd_anggota"];?>">
                          <button class="btn btn-primary btn-xs"><i class="fa fa-print "></i></button>
                        </a>
                        <a href="dokumen_bEnd.php?aksi=hapus&id=<?php echo $row['kd_dok']; ?>">
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </a>
                    </td>
                  </tr>

                  <?php 
                    $i++;
                    endforeach;
                  ?>

                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> List Kehadiran Kegiatan</h3>

        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kegiatan</th>
                    <th>Tgl. Kegiatan</th>
                    <th>Status</th>
                    <th class="center">Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                  $i=1;
                  foreach ($kehadiran as $row):
                  ?>

                  <tr class="gradeA">
                    <th><?= $i; ?>.</th>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["kegiatan"]; ?></td>
                    <td><?= date('d F Y', strtotime($row["tanggal"])); ?></td>
                    <td><?= $row["status"]; ?></td>
                    <td class="center">

                        <?php
                        if ($row["status"] == 'n'){
                        ?>

                        <a href="dokumen_bEnd.php?aksi=update&kd_kegiatan=<?php echo $row['kd_kegiatan']; ?>&kd_anggota=<?php echo $row['kd_anggota']; ?>">
                          <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                        </a>

                        <?php 
                        }
                        ?>

                        <a href="dokumen_bEnd.php?aksi=simpan&kd_kegiatan=<?php echo $row['kd_kegiatan']; ?>&kd_anggota=<?php echo $row['kd_anggota']; ?>">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-save"></i></button>
                        </a>

                    </td>
                  </tr>

                  <?php 
                    $i++;
                    endforeach;
                  ?>

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
        <a href="dokumen_bEnd.php" class="go-top">
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
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    // $(document).ready(function() {
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

    //   /*
    //    * Initialse DataTables, with no sorting on the 'details' column
    //    */
    //   var oTable = $('#hidden-table-info').dataTable({
    //     "aoColumnDefs": [{
    //       "bSortable": false,
    //       "aTargets": [0]
    //     }],
    //     "aaSorting": [
    //       [1, 'asc']
    //     ]
    //   });

    //   /* Add event listener for opening and closing details
    //    * Note that the indicator for showing which row is open is not controlled by DataTables,
    //    * rather it is done here
    //    */
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
    // });
  </script>
</body>

</html>
