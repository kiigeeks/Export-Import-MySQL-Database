<?php
  //konfigurasi database
  $host = "localhost"; 
  $username= "root";  
  $password= ""; 
  $db_name = ""; 

  //koneksi ke database
  $kon = new mysqli($host,$username,$password,$db_name);

  //cek koneksi ke database berhasil atau tidak
  if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
	}
?>
