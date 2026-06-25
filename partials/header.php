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
    <title>Sistem Inventaris - Surface</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/toastr.min.css">
    <link rel="stylesheet" href="assets/DataTables-1.13.3/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="assets/jquery-3.6.1.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/toastr.min.js"></script>
    <script src="assets/DataTables-1.13.3/js/jquery.dataTables.min.js"></script>
    
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

        .navbar-center-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 200px;
            height: calc(100% - 56px);
            background-color: #3d3d3d;
            padding-top: 20px;
            z-index: 999;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #adadad;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #4d4d4d;
            color: #ffffff;
        }

        .main-content {
            margin-left: 200px;
            padding: 20px;
            flex: 1;
            position: relative;
            min-height: 85vh;
        }

        .main-content::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/image/big_logo.jpeg'); 
            background-repeat: no-repeat;
            background-position: center 60%;
            background-size: 400px;
            opacity: 0.05;
            z-index: -1;
            pointer-events: none;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                margin-top: 55px;
                background: #FFFDD0;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top position-relative" style="background: linear-gradient(135deg, #FFFDD0 0%, #F5F5DC 100%); border-bottom: 3px solid #E6E2AF; min-height: 56px;">
        <div class="container-fluid">
            
            <a class="navbar-brand navbar-center-brand" href="home.php">
                <img src="assets/image/logo-text.svg" alt="Surface Logo" height="50">
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link text-dark">
                            <i class="fa-regular fa-user me-1"></i> Welcome Back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                        </span>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="sidebar py-4">
        <div class="text-center mb-4 px-3 pb-3" style="border-bottom: 1px solid #4d4d4d;">
            <img src="assets/image/logo-light.png" alt="Logo Sidebar" class="img-fluid" style="max-height: 45px; object-fit: contain;">
        </div>

        <a href="index.php">
            <i class="fa-solid fa-gauge me-2"></i> Dashboard
        </a>
        <a href="inventaris.php">
            <i class="fa-solid fa-boxes-stacked me-2"></i> Inventaris
        </a>
        <a href="user.php">
            <i class="fa-solid fa-users me-2"></i> User
        </a>
        <a href="login/logout.php" class="text-danger mt-2">
            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
        </a>
    </div>