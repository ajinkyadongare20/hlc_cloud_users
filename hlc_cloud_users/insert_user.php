<!DOCTYPE html>
<html lang="en">
<?php
// DB connection
include 'db_con.php';
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle insert
if (isset($_POST['insert'])) {
    $mid = $_POST['mid'];
    $pid = $_POST['pid'];
    $username = $_POST['username'];
    $user_type = $_POST['pid'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $subscription_start = date('Y-m-d H:i:s', strtotime($_POST['subscription_start']));
    $subscription_end = date('Y-m-d H:i:s', strtotime($_POST['subscription_end']));

    $sql = "INSERT INTO heat_load_subscription 
            (mid, pid, user_id, user_type, subscription_type, subscription_start, subscription_end, is_active)
            VALUES 
            ('$mid', '$pid', '$username', '$user_type', 'Free', '$subscription_start', '$subscription_end', '$is_active')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center'> User inserted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'> Error: " . mysqli_error($conn) . "</div>";
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
    <link href="img/favicon.ico" rel="icon">
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow w-100" style="max-width: 600px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary mb-0">Insert New User</h4>
                <a href="hlc_users.php" class="btn btn-outline-primary btn-sm">← Back</a>
            </div>
            <form method="POST">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="mid" class="form-label">MID</label>
                        <input type="text" class="form-control" name="mid" id="mid" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="pid" class="form-label">PID</label>
                        <input type="text" class="form-control" name="pid" id="pid" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">User ID</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="userType" class="form-label">User Type</label>
                        <select class="form-select" name="user_type" id="userType" required>
                            <option disabled selected>Select user type</option>
                            <option value="Admin">Admin</option>
                            <option value="Editor">Editor</option>
                            <option value="Viewer">Viewer</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="subscriptionStart" class="form-label">Subscription Start</label>
                        <input type="datetime-local" class="form-control" name="subscription_start" id="subscriptionStart" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="subscriptionEnd" class="form-label">Subscription End</label>
                        <input type="datetime-local" class="form-control" name="subscription_end" id="subscriptionEnd" required>
                    </div>

                    <div class="mb-3 col-12 d-flex align-items-center">
                        <input class="form-check-input me-2" type="checkbox" name="is_active" id="isActive">
                        <label class="form-check-label" for="isActive">Is Active</label>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" name="insert" class="btn btn-primary">Insert User</button>
                </div>
            </form>

        </div>
    </div>
</div>

    <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
</body>


</html>