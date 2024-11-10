<?php
session_start();

if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit();
}

require('functions.php');


//ambil data di URL
$id = $_GET["id"];

//query data siswa berdasarkan id
$sws = query("SELECT * FROM siswa WHERE id = $id")[0];


//cek apakah submit sudah ditekan atau belum
if ( isset($_POST["submit"])) {
	
	//cek apakah data berhasil di tambahkan
	if(ubah($_POST) > 0){
		echo "
			<script>
				alert('data berhasil diubah');
				document.location.href = 'index.php';
			
			</script>
		"; 
		
		
	}else{
		echo "
			<script>
				alert('data gagal diubah');
				document.location.href = 'index.php';
			</script>
		"; 
		echo mysqli_error($conn);
		
	}
	
}


?>


<!DOCTYPE html>
<html lang="en">

<head>


</head>

<body>

	<h1>Ubah Data Siswa</h1>

	<form action="" method="post">

		<input type="hidden" name="id" value="<?= $sws["id"] ?>">
		<ul>
			
			<li>
				<label for="nama">Nama :</label>
				<input type="text" name="nama" id="nama" required value="<?= $sws["nama"] ?>">
			</li>
			<li>
				<label for="nisn">Nisn :</label>
				<input type="text" name="nisn" id="nisn" required value="<?= $sws["nisn"] ?>">
			</li>
			<li>
				<label for="jurusan">Jurusan :</label>
				<input type="text" name="jurusan" id="jurusan" required value="<?= $sws["jurusan"] ?>">
			</li>
			<li>
				<label for="kelas">Kelas :</label>
				<input type="text" name="kelas" id="kelas" required value="<?= $sws["kelas"] ?>">
			</li>
		</ul>
		
		<button type="submit" name="submit">Ubah Data</button>
	</form>
	

</body>

</html>