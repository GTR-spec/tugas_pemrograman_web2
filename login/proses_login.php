<?php
include '../koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM tb_login WHERE username=? AND password=?";
    $stmt  = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            $_SESSION['username'] = $row['username'];
            $_SESSION['status']   = "login";
            
            mysqli_stmt_close($stmt);
            
            header("Location: ../home.php");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            
            echo "<script>alert('Login gagal. Periksa kembali username dan password Anda.'); window.location.href = '../login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Terjadi kesalahan pada sistem database server.'); window.location.href = '../login.php';</script>";
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
