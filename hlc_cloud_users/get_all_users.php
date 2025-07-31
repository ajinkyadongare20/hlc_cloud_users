<?php
include 'db_con.php';

// Get start and end dates from GET or default to today and +1 month
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$endDate   = isset($_GET['end_date'])   ? $_GET['end_date']   : date('Y-m-d', strtotime('+1 month'));

// Sanitize input
$startDate = date('Y-m-d', strtotime($startDate));
$endDate   = date('Y-m-d', strtotime($endDate));

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
    <title>HLC Cloud – Custom Date Range Subscriptions</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" href="img/Leal_Logo.jpg" type="image/jpg">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Library CSS -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Bootstrap & Custom CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>HLC Project</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Subodh M</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Dashboard</a>
                    <a href="hlc_users.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded p-4">
                    <h4 class="mb-4 text-center">
                        Subscriptions Ending Between <b><?= $startDate ?></b> and <b><?= $endDate ?></b>
                    </h4>

                    <!-- Date Range Filter -->
                    <form method="GET" class="row mb-4 justify-content-center">
                        <div class="col-md-3 mb-2">
                            <label for="start_date" class="form-label fw-semibold">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $startDate ?>" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="end_date" class="form-label fw-semibold">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $endDate ?>" required>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" class="btn btn-primary w-100 mt-2">View Subscription</button>
                        </div>
                    </form>

                    <!-- Data Table -->
                    <div class="table-responsive mb-3">
                        <table id="userTable" class="table table-striped table-bordered table-hover align-middle text-center">
                            <thead class="table-primary text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>PID</th>
                                    <th>MID</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $userId = $row['pid'];
                                        $statusBadge = $row['is_active'] ? "success" : "secondary";
                                        $statusText  = $row['is_active'] ? "Active" : "Inactive";

                                        echo "<tr>
                                                <td><span class='fw-bold'>{$i}</span></td>
                                                <td>{$row['user_id']}</td>
                                                <td>{$row['pid']}</td>
                                                <td>{$row['mid']}</td>
                                                <td><span class='badge bg-{$statusBadge}'>{$statusText}</span></td>
                                                <td>{$row['subscription_start']}</td>
                                                <td>{$row['subscription_end']}</td>
                                                <td>
                                                    <a href='send_csv_mail.php?user_id={$userId}' title='Send CSV via Email'>
                                                        <i class='fa fa-envelope text-primary fs-5'></i>
                                                    </a>
                                                </td>
                                            </tr>";
                                        $i++;
                                    }
                                } else {
                                    echo "<tr><td colspan='8' class='text-center text-danger'>No subscriptions found in this date range.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Export CSV Button -->
                    <div class="text-center mb-3">
                        <button id="exportCSV" class="btn btn-success">
                            <i class="fas fa-file-csv me-2"></i>Export to CSV
                        </button>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center">
                        <a href="dashboard.php" class="btn btn-sm btn-primary">← Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Dependencies -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="js/main.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function () {
            var table = $('#userTable').DataTable({
                pageLength: 5,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                dom: '<"top"lf>rt<"bottom"ip>',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        className: 'btn btn-success btn-sm mb-3',
                        filename: 'subscriptions_export_<?= $startDate ?>_to_<?= $endDate ?>',
                        exportOptions: { 
                            columns: ':visible',
                            modifier: {
                                page: 'all'
                            }
                        }
                    }
                ]
            });

            // Trigger CSV export when our custom button is clicked
            $('#exportCSV').click(function() {
                table.button('.buttons-csv').trigger();
            });
        });

        function updateStatus(pid, user_id, ischecked) {
            if (confirm('Are you sure you want to update the status?')) {
                const newStatus = ischecked === "" ? 1 : 0;
                window.location.href = `update_status.php?pid=${pid}&user_id=${user_id}&is_active=${newStatus}`;
            }
        }
    </script>
</body>
</html>