<?php

include '../koneksi.php';
if (isset($_GET['user_id'])) {
    $user_id= $_GET['user_id'];
    $query = "SELECT * FROM tb_login WHERE user_id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);
    echo json_encode($user);
}