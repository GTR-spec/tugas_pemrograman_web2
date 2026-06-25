<?php

include '../koneksi.php';
if ($_POST) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE tb_login SET username = '$username', password = '$password' WHERE user_id = '$user_id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data berhasil diupdate";
    } else {
        echo "Data gagal diupdate";
    }
}