<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["uplot"])) {

      if($_FILES["database2"]["name"] != '') {
        $array = explode(".", $_FILES["database2"]["name"]);
        $extension = end($array);

        if($extension == 'sql') {
          //DROP ALL DATA DB
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
            //IMPORT TABLE
            $conn = mysqli_connect("localhost", "root", "", "db_testing");
            $count = 0;          
            $query = '';
            $sqlScript = file($_FILES["database2"]["tmp_name"]);

            foreach ($sqlScript as $line)	{
              $startWith = substr(trim($line), 0 ,2);
              $endWith = substr(trim($line), -1 ,1);
        
              if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
              }
                
              $query = $query . $line;

              if ($endWith == ';') {
                mysqli_query($conn,$query);
                $query= '';		
              }
            }
            echo ("<script LANGUAGE='JavaScript'>
              window.alert('sql Berhasil diImport');
              window.location.href='index.php';
              </script>");
          }else{
            mysqli_rollback($kon);
          }
          
        } else {
          echo ("<script LANGUAGE='JavaScript'>
            window.alert('File Harus Berekstensi sql');
            window.location.href='index.php';
            </script>");
        }
      } else {
        echo ("<script LANGUAGE='JavaScript'>
          window.alert('Pilih File sql Yang Akan diUpload');
          window.location.href='index.php';
          </script>");
      }
    }
  }

?>
