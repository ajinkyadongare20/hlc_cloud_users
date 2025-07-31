<?php
include 'db_con.php';

// Count all users
$activeCount = 0;
$inactiveCount = 0;

$sql = "SELECT is_active FROM heat_load_subscription";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['is_active'] == 1) {
        $activeCount++;
    } else {
        $inactiveCount++;
    }
}

// Count monthly users whose subscription ends in this month
$monthlyActive = 0;
$monthlyInactive = 0;

$firstDayOfMonth = date('Y-m-01');
$lastDayOfMonth = date('Y-m-t');

$sqlMonthly = "SELECT is_active FROM heat_load_subscription 
               WHERE subscription_end BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'";
$resultMonthly = mysqli_query($conn, $sqlMonthly);

while ($row = mysqli_fetch_assoc($resultMonthly)) {
    if ($row['is_active'] == 1) {
        $monthlyActive++;
    } else {
        $monthlyInactive++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HLC Cloud</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" href="img/Leal_Logo.jpg" type="image/jpg">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">

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
                    <a href="hlc_users.php" class="nav-item nav-link my-1"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="dashboard.php" class="nav-item nav-link active my-1"><i
                            class="fa fa-chart-bar me-2"></i>Dashboard</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!-- Weekly User Status Pie Chart -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">User Status - Weekly (Pie Chart)</h6>
                            <canvas id="weekly-chart" class="chart-container"></canvas>
                            <div class="text-center">
                                <button class="btn btn-primary mt-3"
                                    onclick="window.location.href='get_weekly_users.php'">
                                    View End Soon Subscriptions (Weekly)
                                </button>
                            </div>
                            <div id="weekly-users-table" class="mt-3"></div>
                        </div>
                    </div>

                    <!-- Monthly User Status Doughnut Chart -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">User Status - Monthly (Doughnut Chart)</h6>
                            <canvas id="monthly-chart" class="chart-container"></canvas>
                            <div class="text-center">
                                <button class="btn btn-warning mt-3"
                                    onclick="window.location.href='get_monthly_users.php'">
                                    View End Soon Subscriptions (Monthly)
                                </button>
                            </div>
                            <div id="monthly-users-table" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success mt-3" onclick="window.location.href='get_all_users.php'">
                        View All Subscriptions (All Range)
                    </button>
                </div>
            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://lealsolution.com">Leal Software Solution</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Chart Data Injection -->
    <script>
        const activeUsers = <?= $activeCount ?>;
        const inactiveUsers = <?= $inactiveCount ?>;
        const monthlyActiveUsers = <?= $monthlyActive ?>;
        const monthlyInactiveUsers = <?= $monthlyInactive ?>;
    </script>


</body>

</html>