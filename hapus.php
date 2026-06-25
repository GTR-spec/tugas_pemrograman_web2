<?php
include 'koneksi.php';

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $nomor_inventaris = $_GET['id'];

    $query = "DELETE FROM tb_inventori WHERE nomor_inventaris = ?";
    
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $nomor_inventaris);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Data berhasil dihapus'); window.location.href='inventaris.php';</script>";
            } else {
                echo "<script>alert('Data tidak ditemukan di database atau sudah dihapus'); window.location.href='inventaris.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal menghapus data terjadi kesalahan internal.'); window.location.href='inventaris.php';</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Gagal menyiapkan perintah database.'); window.location.href='inventaris.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan atau tidak valid'); window.location.href='inventaris.php';</script>";
}
?>