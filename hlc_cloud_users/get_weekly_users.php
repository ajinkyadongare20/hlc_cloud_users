<?php
include 'db_con.php';

$today = date('Y-m-d');
$sevenDaysLater = date('Y-m-d', strtotime('+7 days'));

$sql = "SELECT * FROM heat_load_subscription WHERE subscription_end BETWEEN '$today' AND '$sevenDaysLater'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HLC Cloud – Weekly Expiring Subscriptions</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link rel="icon" href="img/Leal_Logo.jpg" type="image/jpg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icons & Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap & Plugins -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
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
                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
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
        <!-- Sidebar End -->

        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded p-4">
                    <h4 class="mb-4 text-center">Subscriptions Ending Within 7 Days</h4>

                    <!-- Results Table -->
                    <div class="table-responsive">
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
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <td><strong>{$i}</strong></td>
                                            <td>{$row['user_id']}</td>
                                            <td>{$row['pid']}</td>
                                            <td>{$row['mid']}</td>
                                            <td><span class='badge bg-" . ($row['is_active'] ? "success" : "secondary") . "'>" . ($row['is_active'] ? "Active" : "Inactive") . "</span></td>
                                            <td>{$row['subscription_start']}</td>
                                            <td>{$row['subscription_end']}</td>
                                            <td>
                                                <a href='subscription_mail.php?pid={$row['pid']}' title='Send CSV via Email'>
                                                    <i class='fa fa-envelope text-primary fs-5'></i>
                                                </a>
                                            </td>
                                        </tr>";
                                    $i++;
                                }
                                if ($i === 1) {
                                    echo "<tr><td colspan='8' class='text-danger text-center'>No subscriptions ending in the next 7 days.</td></tr>";
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

                    <div class="text-center mt-3">
                        <a href="dashboard.php" class="btn btn-sm btn-primary">← Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content End -->
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables + Buttons -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

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
                        filename: 'weekly_expiring_subscriptions_<?= $today ?>_to_<?= $sevenDaysLater ?>',
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
    </script>
</body>
</html>