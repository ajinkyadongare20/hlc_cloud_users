<!DOCTYPE html>
<html lang="en">
<?php 
function get_all_users($conn){
    $response_data = array("status"=>false,'message'=>"Something went wrong...!");
    if($conn){
        $pid = $_GET['pid'];
         $sql = "DELETE from heat_load_subscription WHERE pid = '$pid'";;
         $result = mysqli_query($conn, $sql);
         return $result;
        }
}


try{
     include 'db_con.php';
    if ($conn->connect_error) {
        echo json_encode(False);
    }
    $response = get_all_users($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
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
                            <h6 class="mb-4">Responsive Table</h6>
                            <div class="table-responsive">
                                <table class="table">
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
                                            <th scope="row">
                                                <?php echo $count++;?>
                                            </th>
                                            <td>
                                                <?php echo $row['user_id'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['pid'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['mid'];?>
                                            </td>
                                            <td>
                                                <?php  $ischecked = "";if( $row['is_active']==1){$ischecked="checked";} ?>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" <?php echo $ischecked; ?> type="checkbox" role="switch"
                                                            id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $row['subscription_start'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['subscription_end'];?>
                                            </td>
                                           <td>
                                            <div class="btn-group">
                                                <!-- Trigger button with just ... -->
                                                <button class="btn btn-link text-dark no-arrow m-0 p-0"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </button>

                                                <!-- Dropdown menu with two options -->
                                                <div class="dropdown-menu dropdown-menu-start mt-2 py-1">
                                                    <!-- View Project -->
                                                    <a href="view_user.php?id=<?php echo $row['id']; ?>" 
                                                    class="dropdown-item">
                                                        View Project
                                                    </a>
                                                    <!-- Delete Project -->
                                                    <a href="delete_project.php?pid=<?php echo $row['pid']; ?>" 
                                                    class="dropdown-item text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this project?');">
                                                        Delete Project
                                                    </a>
                                                </div>
                                            </div>
                                        </td>


                                        </tr>
                                        <?php 
                                        }
                                    }
                                    ?>

                                    </tbody>
                                </table>
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
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
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