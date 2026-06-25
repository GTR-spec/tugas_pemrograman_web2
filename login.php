<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Surface Head Office</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <style>
        body {
            background-image: url('assets/image/kantor-img.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .login-container {
            position: relative;
            z-index: 2;
        }

        .card-login {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            border: none;
        }
    </style>
</head>

<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center login-container">
        <div class="card shadow-lg p-4 card-login rounded-3" style="width: 100%; max-width: 420px;">
            <h3 class="card-title text-center mb-4 fw-bold text-dark">LOGIN</h3>
            
            <form action="login/proses_login.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required autocomplete="username">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Sign In</button>
            </form>
        </div>
    </div>
</body>

</html>