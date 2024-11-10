<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit();
}

require "functions.php";

//pagination
//konfigurasi
$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM siswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = isset($_GET["halaman"]) ? $_GET["halaman"] : 1;
$awalData = $jumlahDataPerHalaman * $halamanAktif - $jumlahDataPerHalaman;

$siswa = query("SELECT * FROM siswa LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari di tekan
if (isset($_POST["cari"])) {
  $siswa = cari($_POST["keyword"]);
}
?>


<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CRUD PHP DASAR </title>
		
			<link rel="stylesheet" href="style.css">
</head>
<body>


<a href="logout.php">Logout!</a>
<h1 style="text-align : center">
  Daftar Siswa SMK N 1 WADASLINTANG
</h1>

<br>

<a href="tambah.php">tambah data siswa</a>

<br>

<form action="" method="post">
	<input type="text" name="keyword" size="40" autofocus placeholder="Masukan Keyword Pencarian..." autocomplete="off">
	<button type="submit" name="cari">Cari!!</button>
</form>

<br><br>

<?php if ($halamanAktif > 1): ?>
	<a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
<?php endif; ?>

<?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
	<?php if ($i == $halamanAktif): ?>
		<a href="?halaman=<?= $i ?>" style="font-wight : bold; color: red;"><?= $i ?></a>
	<?php else: ?>
		<a href="?halaman=<?= $i ?>"><?= $i ?></a>
	<?php endif; ?>
<?php endfor; ?>

<?php if ($halamanAktif < $jumlahHalaman): ?>
	<a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
<?php endif; ?>

<br>

<div id="tabel">

<table border="1" cellpadding="10" cellspacing"0" style="text-align: center">

  <tr>
    
    <th>No</th>
    <th>CRUD</th>
    <th>nama</th>
    <th>nisn</th>
    <th>jurusan</th>
    <th>kelas</th>
    
  </tr>
  <?php $i = 1; ?>
  <?php foreach ($siswa as $row): ?>
  <tr>
    <td> <?= $i ?></td>

    <td>
      <a href="ubah.php?id=<?= $row["id"] ?>">ubah</a>
      <a href="hapus.php?id=<?= $row[
        "id"
      ] ?> "onclick = " return confirm('yakin?');"> | hapus</a>
    </td>
    <td><?= $row["nama"] ?></td>
    <td><?= $row["nisn"] ?></td>
    <td><?= $row["jurusan"] ?></td>
    <td><?= $row["kelas"] ?></td>

  </tr>
  <?php $i++; ?>
  <?php endforeach; ?>
	</table>
</div>
</body>
</html>