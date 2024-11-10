<?php

//konesksi ke database

$conn = mysqli_connect("0.0.0.0:3306", "root", "admin123", "php_dasar");

//ambil data dari tabel siswa / query data siswa

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  
  return $rows;

}




function tambah($data){
	global $conn;
	
	
	$nama = htmlspecialchars($data["nama"]);
	$nisn = htmlspecialchars($data["nisn"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$kelas = htmlspecialchars($data["kelas"]);
	
	$query = "INSERT INTO siswa
							VALUES
							(NULL, '$nama', '$nisn','$jurusan', 
							'$kelas' )
							";
							
					mysqli_query($conn, $query);
					
		return mysqli_affected_rows($conn);
}

function hapus($id){
	global $conn;
	
	mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
	
	return mysqli_affected_rows($conn);
}


function ubah($data){
	global $conn;
	
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nisn = htmlspecialchars($data["nisn"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$kelas = htmlspecialchars($data["kelas"]);
	
	$query = "UPDATE siswa SET 
							nama = '$nama',
							nisn = '$nisn',
							jurusan = '$jurusan',
							kelas = '$kelas'
							WHERE id = $id
							";
							
					mysqli_query($conn, $query);
					
		return mysqli_affected_rows($conn);
		
		
}

function cari($keyword){
	$query = "SELECT * FROM siswa 
							WHERE 
							nama LIKE '%$keyword%' OR
							nisn LIKE '%$keyword%' OR
							jurusan LIKE '%$keyword%' OR
							kelas LIKE '%$keyword%'
							";
		return query($query);
}


function registrasi($data){
	global $conn;
	
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	
	//cek apakah username sudah ada atau belum
	
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");
	
	if(mysqli_fetch_assoc($result)){
		echo   "<script>
						alert('username sudah terdaftar!');
					</script>";
					return false;
	}
	
	//cek konfirmasi password
	if($password !== $password2){
		echo  "<script>
						alert('konfirmasi password tidak 
						sesuai!');
					</script>";
					return false;
	}
	
	//enkripsi password
	$hashMethod = PASSWORD_BCRYPT;
	$password = password_hash($password, $hashMethod);
	
	//tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$username', '$password')");
	
  return mysqli_affected_rows($conn);
	
}








?>
