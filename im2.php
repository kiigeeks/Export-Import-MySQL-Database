
    <?php
      $sqlScript = '12-10-2021_202203_db_testing_backup.sql';
      $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '';
      $dbname = 'db_testing';
      
      try{
        Shell_exec('C:\xampp\mysql\bin\mysqlimport --user='.$dbuser.' --password='.$dbpass.' '.$dbname.' < 12-10-2021_202203_db_testing_backup.sql');
        // echo ("<script LANGUAGE='JavaScript'>
        //   window.alert('Berhasil di Upload');
        //   window.location.href='index.php';
        //   </script>");
      } catch (\Exception $e) {
        echo 'mysqldump error: '. $e;
      }
      
      ?>

