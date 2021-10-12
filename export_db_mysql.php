<?php
    // koneksi ke database di file koneksi.php
    include "koneksi.php";
    // inisialisasi timezone
	date_default_timezone_set('Asia/Jakarta');	

    // set the charset
    $kon->set_charset("utf8");

    // menampilkan semua nama tabel yang ada di database
    $tables = array();
    $sql = "SHOW TABLES";
    $result = mysqli_query($kon, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }

    $sqlScript = "";

    foreach ($tables as $table) {
        // membuat struktur tabel
        $query = "SHOW CREATE TABLE $table";
        $result = mysqli_query($kon, $query);
        $row = mysqli_fetch_row($result);
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
        $query = "SELECT * FROM $table";
        $result = mysqli_query($kon, $query);
        $columnCount = mysqli_num_fields($result);

        // melakukan dumping data tiap tabel
        for ($i = 0; $i < $columnCount; $i ++) {
            while ($row = mysqli_fetch_row($result)) {
                $sqlScript .= "INSERT INTO $table VALUES(";
                for ($j = 0; $j < $columnCount; $j ++) {
                    $row[$j] = $row[$j];
                if (isset($row[$j])) {
                        $sqlScript .= '"' . $row[$j] . '"';
                    } else {
                        $sqlScript .= '""';
                    }
                    if ($j < ($columnCount - 1)) {
                        $sqlScript .= ',';
                    }
                }
                $sqlScript .= ");\n";
            }
        }
        $sqlScript .= "\n"; 
    }
    
    if(!empty($sqlScript)){
        // memberi nama file backup
        $backup_file_name = date('d-m-Y_His'). '_'. $database_name . '_backup.sql';

        //Download sql di lokal folder
        $fileHandler = fopen($backup_file_name, 'w+');
        $number_of_lines = fwrite($fileHandler, $sqlScript);
        fclose($fileHandler); 
        
        // Download sql di folder Download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_file_name));
        ob_clean();
        flush();
        readfile($backup_file_name);
        exec('rm ' . $backup_file_name); 
    }
?>