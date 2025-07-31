<!DOCTYPE html>
<html lang="en">
<?php
// DB connection
include 'db_con.php';
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error());
}

// Fetch the latest user data
$id = 0;
$userData = [];
$pid = $_GET['pid'];
$sql = "SELECT * FROM heat_load_subscription where pid = '$pid' ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $pid = $userData['pid'];
}

// Handle update
if (isset($_POST['update'])) {
    $pid = $_POST['pid'];
    $username = $_POST['username'];
    $user_type = $_POST['user_type'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $subscription_start = date('Y-m-d H:i:s', strtotime($_POST['subscription_start']));
    $subscription_end = date('Y-m-d H:i:s', strtotime($_POST['subscription_end']));
    $remaining_count = $_POST['remaining_count'];
    $sql = "UPDATE heat_load_subscription SET 
                user_type = '$user_type',
                is_active = '$is_active',
                remaining_count = '$remaining_count',
                subscription_start = '$subscription_start',
                subscription_end = '$subscription_end'
            WHERE pid = '$pid' ";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center'>✅ Record updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<head>
    <meta charset="utf-8">
    <title>Update User</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" href="img/Leal_Logo.jpg" type="image/jpg">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">


    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries CSS -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">

        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>HLC Project</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Subodh M</h6>
                        <span>Admin</span>
                    </div>
                </div>
               <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Dashboard</a>
                    <a href="hlc_users.php" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Tables</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <div class="card shadow w-100" style="max-width: 600px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-primary mb-0">Update User</h4>
                    <a href="view_user.php" class="btn btn-outline-primary btn-sm">← Back</a>
                </div>
                <form method="POST">
                    <input type="hidden" name="pid" value="<?= $pid ?>">

                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" id="username" required
                            value="<?= isset($userData['user_id']) ? $userData['user_id'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="userType" class="form-label">User Type</label>
                        <select class="form-select" name="user_type" id="userType" required>
                            <option value="Single User" <?=(isset($userData['user_type']) &&
                                $userData['user_type']==='Single User' ) ? 'selected' : '' ?>>Single User</option>
                            <option value="Server User" <?=(isset($userData['user_type']) &&
                                $userData['user_type']==='Server User' ) ? 'selected' : '' ?>>Server User</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="userType" class="form-label">Number Of Login</label>
                        <select class="form-select" name="remaining_count" id="remaining_count" required>
                            <option value="1" <?=(isset($userData['remaining_count']) &&
                                $userData['remaining_count']==='1' ) ? 'selected' : '' ?>>1</option>
                            <option value="2" <?=(isset($userData['remaining_count']) &&
                                $userData['remaining_count']==='2' ) ? 'selected' : '' ?>>2</option>
                            <option value="3" <?=(isset($userData['remaining_count']) &&
                                $userData['remaining_count']==='3' ) ? 'selected' : '' ?>>3</option>
                            <option value="4" <?=(isset($userData['remaining_count']) &&
                                $userData['remaining_count']==='4' ) ? 'selected' : '' ?>>4</option>
                            <option value="5" <?=(isset($userData['remaining_count']) &&
                                $userData['remaining_count']==='5' ) ? 'selected' : '' ?>>5</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subscriptionStart" class="form-label">Subscription Start</label>
                        <input type="datetime-local" class="form-control" name="subscription_start"
                            id="subscriptionStart" required
                            value="<?= isset($userData['subscription_start']) ? date('Y-m-d\TH:i', strtotime($userData['subscription_start'])) : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="subscriptionEnd" class="form-label">Subscription End</label>
                        <input type="datetime-local" class="form-control" name="subscription_end" id="subscriptionEnd"
                            required
                            value="<?= isset($userData['subscription_end']) ? date('Y-m-d\TH:i', strtotime($userData['subscription_end'])) : '' ?>">
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive"
                            <?=(isset($userData['is_active']) && $userData['is_active']==1) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="isActive">Is Active</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="update" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

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

    <!-- Custom JS -->
    <script src="js/main.js"></script>
    <!-- <script>
    function toggleForm(id) {
        const row = document.getElementById('formRow_' + id);
        row.style.display = (row.style.display === 'none') ? 'table-row' : 'none';
    }
</script> -->

</body>

</html>