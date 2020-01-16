<?php
	date_default_timezone_set('Asia/Jakarta');
    $db_host = 'localhost'; // Nama Server
    $db_user = 'root'; // User Server
    $db_pass = ''; // Password Server
    $db_name = 'dbtesscraper'; // Nama Database
    
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
      die ('Gagal terhubung MySQL: ' . mysqli_connect_error());	
    }
?>