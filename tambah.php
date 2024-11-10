<?php

session_start();

if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit();
}

require('functions.php');

if ( isset($_POST["submit"])) {
	
	//cek apakah data berhasil di tambahkan
	if(tambah($_POST) > 0){
		echo "
			<script>
				alert('data berhasil ditambahkan');
				document.location.href = 'index.php';
			
			</script>
		"; 
	}else{
		echo "
			<script>
				alert('data gagal  ditambahkan');
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

	<h1>Tambah Data Siswa</h1>

	<form action="" method="post">

		<ul>
			<li>
				<label for="nama">Nama :</label>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li>
				<label for="nisn">Nisn :</label>
				<input type="text" name="nisn" id="nisn" required>
			</li>
			<li>
				<label for="jurusan">Jurusan :</label>
				<input type="text" name="jurusan" id="jurusan" required>
			</li>
			<li>
				<label for="kelas">Kelas :</label>
				<input type="text" name="kelas" id="kelas" required>
			</li>
		</ul>
		
		<button type="submit" name="submit">Tambah Data</button>
	</form>
	

</body>

</html>