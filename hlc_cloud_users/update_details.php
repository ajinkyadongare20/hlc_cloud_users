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

    $sql = "UPDATE heat_load_subscription SET 
                user_id = '$username',
                is_active = '$is_active',
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
    <div class="card shadow w-100" style="max-width: 600px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary mb-0">Update User</h4>
                <a href="hlc_users.php" class="btn btn-outline-primary btn-sm">← Back</a>
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
                        <option disabled <?= !isset($userData['pid']) ? 'selected' : '' ?>>Select user type</option>
                        <option value="Admin" <?= (isset($userData['pid']) && $userData['pid'] === 'Admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="Editor" <?= (isset($userData['pid']) && $userData['pid'] === 'Editor') ? 'selected' : '' ?>>Editor</option>
                        <option value="Viewer" <?= (isset($userData['pid']) && $userData['pid'] === 'Viewer') ? 'selected' : '' ?>>Viewer</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="subscriptionStart" class="form-label">Subscription Start</label>
                    <input type="datetime-local" class="form-control" name="subscription_start" id="subscriptionStart" required
                           value="<?= isset($userData['subscription_start']) ? date('Y-m-d\TH:i', strtotime($userData['subscription_start'])) : '' ?>">
                </div>

                <div class="mb-3">
                    <label for="subscriptionEnd" class="form-label">Subscription End</label>
                    <input type="datetime-local" class="form-control" name="subscription_end" id="subscriptionEnd" required
                           value="<?= isset($userData['subscription_end']) ? date('Y-m-d\TH:i', strtotime($userData['subscription_end'])) : '' ?>">
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive"
                        <?= (isset($userData['is_active']) && $userData['is_active'] == 1) ? 'checked' : '' ?>>
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
