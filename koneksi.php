<?php
$server   = "sql213.byetcluster.com";
$username = "b7_42270965";
$password = "ballistixtracer";
$database = "b7_42270965_inventaris_kantor";

$koneksi = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
?><?php
$server   = "localhost";
$username = "root";
$password = "";
$database = "inventaris_kantor";

$koneksi = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
    
}

mysqli_set_charset($koneksi, "utf8mb4");
?>
