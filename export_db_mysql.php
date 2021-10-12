<?php
  // inisialisasi timezone
	date_default_timezone_set('Asia/Jakarta');	

  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'db_testing';

  // memberi nama file backup
  $backup_file_name = date('d-m-Y_His'). '_'. $dbname . '_backup.sql';

  try{
    Shell_exec('C:\xampp\mysql\bin\mysqldump --user='.$dbuser.' --password='.$dbpass.' --host='.$dbhost.' '.$dbname.' > Download-DB/'.$backup_file_name);
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('Berhasil di Download');
      window.location.href='index.php';
      </script>");
  } catch (\Exception $e) {
    echo 'mysqldump error: '. $e;
  }
?>