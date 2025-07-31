<?php
include 'db_con.php';

// Get selected date from GET or use today
$selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$startDate = $selectedDate;
$endDate = date('Y-m-d', strtotime($selectedDate . ' +1 month'));

// Fetch subscriptions ending in this range
$sql = "SELECT * FROM heat_load_subscription 
        WHERE subscription_end BETWEEN '$startDate' AND '$endDate' 
        ORDER BY subscription_end ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HLC Cloud – Monthly Expiring Subscriptions</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link rel="icon" href="img/Leal_Logo.jpg" type="image/jpg">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Stylesheets -->
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
                    <a href="hlc_users.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="dashboard.php" class="nav-item nav-link active"><i
                            class="fa fa-chart-bar me-2"></i>Dashboard</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded p-4">
                    <h4 class="mb-4 text-center">
                        Subscriptions Ending from <b>
                            <?= $startDate ?>
                        </b> to <b>
                            <?= $endDate ?>
                        </b>
                    </h4>

                    <!-- Date Picker Form -->
                    <form method="GET" class="row mb-4 justify-content-center">
                        <div class="col-auto">
                            <label for="date" class="form-label fw-semibold">Select Start Date:</label>
                            <input type="date" id="date" name="date" class="form-control" value="<?= $selectedDate ?>"
                                required>
                        </div>
                        <div class="col-auto align-self-end">
                            <button type="submit" class="btn btn-primary mt-2">View Subscriptions</button>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>PID</th>
                                    <th>MID</th>
                                    <th>Active</th>
                                    <th>Subscription Start</th>
                                    <th>Subscription End</th>
                                    <th>Email CSV</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>{$i}</td>
                                        <td>{$row['user_id']}</td>
                                        <td>{$row['pid']}</td>
                                        <td>{$row['mid']}</td>
                                        <td>" . ($row['is_active'] ? 'Yes' : 'No') . "</td>
                                        <td>{$row['subscription_start']}</td>
                                        <td>{$row['subscription_end']}</td>
                                        <td>
                                            <a href='send_csv_mail.php?user_id={$row['user_id']}' title='Send CSV via Email'>
                                                <i class='fa fa-envelope text-primary'></i>
                                            </a>
                                        </td>
                                    </tr>";
                                    $i++;
                                }

                                } else {
                                    echo "<tr><td colspan='7' class='text-center text-danger'>No subscriptions found in this date range.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-3">
                        <a href="dashboard.php" class="btn btn-sm btn-primary">
                            ← Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>