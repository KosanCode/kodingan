<?php

$koneksi = mysqli_connect ("localhost", "root", "", "kamabaa");


function jmlKomen($query)
	{
		global $koneksi;
		
		$res	= mysqli_query($koneksi, $query);
		
		$rows = mysqli_num_rows($res);
		
		return $rows;
	}