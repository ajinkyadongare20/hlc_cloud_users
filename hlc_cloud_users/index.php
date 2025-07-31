<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'golden7') {
        $_SESSION['username'] = $username;

        // Detect environment and redirect accordingly
        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
            // For localhost
            header("Location: /wordpess_projects/hlc_cloud_users/hlc_cloud_users/view_user.php");
        } else {
            // For server
            header("Location: /demo-hlccloud/view_user.php");
        }
        exit;
    } else {
        echo "Login Failed";
    }
}
?>


<head>
    <meta charset="utf-8">
    <title>HLC Cloud</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/Leal_Logo.jpg" type="image/jpg">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Bootstrap & Template Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">

        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Login Form Start -->
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="card shadow-lg rounded-4 p-4" style="width: 100%; max-width: 400px;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Login</h2>
                    <p class="text-muted">Welcome back to HLC Cloud</p>
                </div>

                <form action="#" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control rounded-3" id="username" name="username"
                            placeholder="Enter username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control rounded-3" id="password" name="password"
                            placeholder="Enter password" required>
                    </div>

                    <div class="d-grid py-3">
                        <input type="submit" class="btn btn-primary rounded-3" name="login" value="Login">
                    </div>
                </form>

                <div id="error-msg" class="text-danger mt-3 text-center" style="display: none;">
                    Invalid username or password
                </div>
            </div>
        </div>
        <!-- Login Form End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Login Validation -->
    <script>
        function validateLogin() {
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();

            // Dummy validation — replace with real login check
            if (username === "admin" && password === "admin123") {
                alert("Login successful!");
                return true;
            } else {
                document.getElementById("error-msg").style.display = "block";
                return false;
            }
        }
    </script>
</body>

</html>