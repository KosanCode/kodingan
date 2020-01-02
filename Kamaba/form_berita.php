<html>
<head>
  <title>Tambah Berita</title>
</script>
</head>
<body>
  <h1>Tambah Berita</h1>
  <form method="post" action="proses_tbhberita.php" enctype="multipart/form-data">
  <table cellpadding="8">
  <tr>
    <td>Judul</td>
    <td><input type="text" name="judul"></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><input type="text" name="nama"></td>
  </tr>
  <tr>
    <td>Isi</td>
    <td><textarea name="isi"></textarea></td>
  </tr>
  <tr>
    <td>Foto</td>
    <td><input type="file" name="gambar"></td>
  </tr>
  </table>
  
  <hr>
  <input type="submit" value="Simpan">
  </form>
</body>
</html>