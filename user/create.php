<?php

include '../koneksi.php';

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO tb_login (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data berhasil disimpan";
    } else {
        echo "Data gagal disimpan";
    }
}