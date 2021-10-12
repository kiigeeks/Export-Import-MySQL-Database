<?php
  //konfigurasi database
  $host = "localhost"; //MySQL Server
  $username= "root";  //MySQL Username
  $password= ""; //MySQL Password
  $db_name = "db_tokoku"; //MySQL Nama Database

  //koneksi ke database
  $kon = new mysqli($host,$username,$password,$db_name);

  //cek koneksi ke database berhasil atau tidak
  if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
  }
?>
