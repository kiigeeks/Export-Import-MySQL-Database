<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["uplot"])) {

      $nama_file = basename($_FILES['filedb']['name']); 
      $lokasi_file = $_FILES['filedb']['tmp_name']; //nama local temp file di server
      $tipe_file = $_FILES['filedb']['type']; //tipe filenya (langsung detect MIMEnya)
      $direktori = "Upload_DB/$nama_file";
      move_uploaded_file($lokasi_file,$direktori);

      // $dbhost = 'localhost';
      // $dbuser = 'root';
      // $dbpass = '';
      // $dbname = 'db_testing';
      // /ENTER THE RELEVANT INFO BELOW
      $mysqlDatabaseName ='db_testing';
      $mysqlUserName ='root';
      $mysqlPassword ='';
      $mysqlHostName ='localhost';
      $mysqlImportFilename =$direktori;

      //DONT EDIT BELOW THIS LINE
      //Export the database and output the status to the page
      $command='C:\xampp\mysql\bin\mysqldump -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
      Shell_exec($command);

    }
  }


?>
