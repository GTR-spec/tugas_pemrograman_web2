<?php

include '../koneksi.php';
if($_POST) {
    $user_id= $_POST['user_id'];
    $query = "DELETE FROM tb_login WHERE user_id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "Data berhasil dihapus";
    } else {
        echo "Data gagal dihapus";
    }
}