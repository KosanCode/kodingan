<?php
	include 'functionkegiatan.php';	

	$kd_kegiatan = $_GET["kd_kegiatan"];
	
	

	$kegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE kd_kegiatan=$kd_kegiatan");
	$hasil = mysqli_fetch_assoc($kegiatan);

	$peserta = query("SELECT * FROM kegiatan JOIN dtl_kegiatan ON dtl_kegiatan.kd_kegiatan=kegiatan.kd_kegiatan WHERE kegiatan.kd_kegiatan = $kd_kegiatan");

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
<div class="container">

<h1 align="center">DATA PESERTA<br> <?= strtoupper($hasil["kegiatan"]); ?>  </h1>
<button><a href="showdatakeg.php">Kembali</a></button><br><br>
<div class="container">
<table class="table">
	<tr>
		<th width="20 px">No.</th>
		<th width="150 px">NAMA</th>
		<th width="250 px">ALAMAT</th>
		<th width="150 px">NO HP</th>
		<th width="150 px">Email</th>
	</tr>
	<?php
	$i=1;
        foreach ($peserta as $row):
    ?>
	<tr>
		<td><?= $i; ?></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["alamat_jogja"]; ?></td>
		<td><?= $row["noHP"]; ?></td>
		<td><?= $row["email"]; ?></td>
	</tr>
	<?php
		$i++;      
        endforeach;
    ?>
</table>
</div>
</div>
</body>
</html>