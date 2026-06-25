<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surface Head Office</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/toastr.min.css">
    <link rel="stylesheet" href="assets/DataTables-1.13.3/css/dataTables.bootstrap.min.css">
    
    <script src="assets/jquery-3.6.1.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/toastr.min.js"></script>
    <script src="assets/DataTables-1.13.3/js/jquery.dataTables.min.js"></script>
</head>
<style>
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
}

.navbar {
    z-index: 1000;
}

.main-content {
    margin-left: 200px;
    padding: 20px;
    flex: 1;
}
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="assets/image/logo.png" alt="Logo" height="50">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>