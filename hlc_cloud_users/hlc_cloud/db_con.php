<?php 

$host = "localhost";
$username = "root";
$password = "";
$database = "hlc_cloud_users";
$conn = mysqli_connect($host, $username, $password, $database);
if ($conn->connect_error) {
    echo json_encode(False);
}


?>