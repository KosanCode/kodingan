<?php
	include 'functionkegiatan.php';	

	$perpage = 5; //kegiatan perhalaman
	$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;

	$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

	$kegiatan = query("SELECT * FROM kegiatan 
						ORDER BY kd_kegiatan 
						DESC LIMIT $start, $perpage");

	$hasil = mysqli_query( $koneksi,"Select * from kegiatan");
	$total = mysqli_num_rows($hasil);
	$pages = ceil($total/$perpage);



?>

<!DOCTYPE html>
<html>
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

<h1 align="center">DATA KEGIATAN</h1>
<div class="container">
<button ><a href="insertkeg.php?action=tambah" style="color: 000; text-decoration-line: none;">Tambah Kegiatan</a></button><br><br>
<table class="table" >
	<thead style="text-align: center;">
		<tr>
			<th>Gambar</th>
			<th>Kegiatan</th>
			<th width="200 px">Deskripsi</th>
			<th>Tanggal</th>
			<th>Tempat</th>
			<th>Iuran</th>
			<th colspan="3">Aksi</th>
		</tr>
	</thead>
	<?php
	$i=1;
        foreach ($kegiatan as $row):
    ?>
    <tbody>
	<tr>
		<td>
			<img src="images/<?= $row["gambar"]; ?>" width="50px">
		</td>
		<td><?= $row["kegiatan"]; ?></td>
		<td><?= limit_words($row["detail"], 10); ?>..........</td>
		<td><?= $format_tanggal = date('d F Y', strtotime($row["tanggal"])); ?></td>
		<td><?= $row["tempat"]; ?></td>
		<td>Rp <?= $row["iuran"]; ?></td>
		<td>
			<button><a href="pesertakeg.php?kd_kegiatan=<?= $row["kd_kegiatan"]; ?>" style="text-decoration-line: none;">LIHAT PESERTA</a></button>
		</td>
		<td>
			<button><a href="editkeg.php?kd_kegiatan=<?= $row["kd_kegiatan"]; ?>" style="color: 000; text-decoration-line: none;">EDIT</a></button>
		</td>
		<td>
			<button><a href="hapuskeg.php?kd_kegiatan=<?= $row["kd_kegiatan"]; ?>" style="color: 000; text-decoration-line: none;">HAPUS</a></button>
		</td>
	</tr>
	</tbody>
	<?php
		$i++;      
        endforeach;
    ?>
</table>
<div class="col-12 mt-5 text-center">
              <div class="custom-pagination">
                <?php 
                    for($j=1; $j<=$pages; $j++){ ?>

                      <a class="active" href="?halaman=<?php echo $j ?>"><?php echo $j ?></a>
                <?php
                    }
                ?>
              </div>
            </div>
</div>

</body>
</html>