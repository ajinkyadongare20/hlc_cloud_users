<!DOCTYPE html>
<html lang="en">
<?php 
function get_all_users($conn){
    $response_data = array("status"=>false,'message'=>"Something went wrong...!");
    if($conn){
         $sql = "SELECT * from heat_load_subscription GROUP BY pid ORDER BY id DESC;";
         $result = mysqli_query($conn, $sql);
         return $result;
        }
}

try{
   include 'db_con.php';
   $response = get_all_users($conn);
}catch (Exception $e) {
    echo json_encode(False);
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">


    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
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

        <!-- Content Start -->
        <div class="content">
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Responsive Table</h6>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="insert_user.php" class="btn btn-primary mx-1"><i class="fa fa-plus"
                                            aria-hidden="true"></i> New User</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="userTable" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">PID</th>
                                            <th scope="col">MID</th>
                                            <th scope="col">Active</th>
                                            <th scope="col">Subscription Start</th>
                                            <th scope="col">Subscription End</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $response = get_all_users($conn);
                                        if(mysqli_num_rows($response) > 0){
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($response)){?>
                                        <tr>
                                            <th scope="row"><?php echo $count++;?></th>
                                            <td><?php echo $row['user_id'];?></td>
                                            <td><?php echo $row['pid'];?></td>
                                            <td><?php echo $row['mid'];?></td>
                                            <td>
                                                <?php  $ischecked = ""; if($row['is_active']==1){$ischecked="checked";} ?>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" <?php echo $ischecked; ?>
                                                    onclick="updateStatus('<?php echo $row['pid']; ?>','<?php echo $row['user_id'];?>','<?php echo $ischecked;?>');"
                                                    type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                                </div>
                                            </td>
                                            <td><?php echo $row['subscription_start'];?></td>
                                            <td><?php echo $row['subscription_end'];?></td>
                                            <td>
                                                <a href="view_user.php?id=<?php echo $row['pid']; ?>" title="View">
                                                    <i class="fas fa-eye" style="color:green; margin-right:8px;"></i>
                                                </a>
                                                <a href="insert_user.php?id=<?php echo $row['pid']; ?>" title="Edit">
                                                    <i class="fas fa-edit" style="color:#009cff85; margin-right:8px;"></i>
                                                </a>
                                                <a href="delete_user.php?pid=<?php echo $row['pid']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete this user?');"
                                                    title="Delete">
                                                    <i class="fa fa-trash" style="color:#ff0000a8;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <button id="exportBtn" class="btn btn-success mt-3"><i class="fas fa-file-export me-2"></i>Export to CSV</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://htmlcodex.com">Leal Software Solution</a>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
    <script>
        function updateStatus(pid, user_id, ischecked) {
            let con = confirm('Are you sure you want to update the status?')
            if (con) {
                if (ischecked == "") {
                    ischecked = 1;
                } else {
                    ischecked = 0;
                }
                window.location.href = "update_status.php?pid=" + pid + "&user_id=" + user_id + "&is_active=" + ischecked;
            }
        }

        $(document).ready(function () {
            $('#userTable').DataTable({
                "pageLength": 5
            });
        });

        // CSV Export Functionality - Standalone version (doesn't depend on DataTables)
        document.getElementById('exportBtn').addEventListener('click', function() {
            // Create CSV content array
            let csvContent = [];
            
            // Add headers (skip the Action column)
            const headers = [];
            document.querySelectorAll('#userTable thead th').forEach(function(th, index) {
                if (index < 7) { // Skip the last column (Action)
                    headers.push(`"${th.textContent.trim().replace(/"/g, '""')}"`);
                }
            });
            csvContent.push(headers.join(','));
            
            // Add data rows
            document.querySelectorAll('#userTable tbody tr').forEach(function(row) {
                const rowData = [];
                const cells = row.querySelectorAll('td, th[scope="row"]');
                
                // Process each cell except the last one (Action column)
                for (let i = 0; i < cells.length - 1; i++) {
                    let cell = cells[i];
                    
                    // Handle the switch status
                    if (cell.querySelector('.form-check-input')) {
                        const isChecked = cell.querySelector('.form-check-input').checked;
                        rowData.push(`"${isChecked ? 'Active' : 'Inactive'}"`);
                    } else {
                        // Normal text content - wrap in quotes and escape existing quotes
                        let text = cell.textContent.trim().replace(/"/g, '""');
                        rowData.push(`"${text}"`);
                    }
                }
                
                csvContent.push(rowData.join(','));
            });
            
            // Create and trigger download
            const blob = new Blob([csvContent.join('\n')], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.setAttribute('href', url);
            link.setAttribute('download', 'users_data_' + new Date().toISOString().slice(0, 10) + '.csv');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    </script>
</body>
</html>