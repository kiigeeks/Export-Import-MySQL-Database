<?php
  // koneksi ke database di file koneksi.php
  include "koneksi.php";
  // inisialisasi timezone
	date_default_timezone_set('Asia/Jakarta');	
	
	$cek=0;
	  
	mysqli_autocommit($kon, false);
	$sql1 = "SET foreign_key_checks = 0";
	$result1 = mysqli_query($kon,$sql1);

	if (!$result1) {
		$cek=$cek+1;
	}
	
	$sql2 = "SHOW TABLES";
	$result2 = mysqli_query($kon, $sql2);
	while ($row = mysqli_fetch_row($result2)) {
			$sql3 = "DROP TABLE IF EXISTS .$row[0]";
			$result3 = mysqli_query($kon,$sql3);
			
			if (!$result3) {
				$cek=$cek+1;
			}
	}
	
	$sql4 = "SET foreign_key_checks = 1";
	$result4 = mysqli_query($kon,$sql4);

	if (!$result4) {
		$cek=$cek+1;
	}

	if ($cek==0){
		mysqli_commit($kon);
		echo ("<script LANGUAGE='JavaScript'>
			window.alert('Berhasil Menghapus All Tabel');
			window.location.href='index.php';
			</script>");
	}else{
		mysqli_rollback($kon);
	}
	mysqli_close($kon);
?>
