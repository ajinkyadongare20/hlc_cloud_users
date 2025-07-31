<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hlc_cloud_users";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM heat_load_subscription 
          WHERE DATEDIFF(subscription_end, NOW()) <= 7 
          AND is_active = 1
          LIMIT 1";

$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    $username = getUserName($conn, $row['user_id']);
    $user_id = $row['user_id'];
    $pid = $row['pid'];
    $sub_start = date("d/m/Y", strtotime($row['subscription_start']));
    $sub_end = date("d/m/Y", strtotime($row['subscription_end']));

    $email_html = <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Subscription Reminder</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 30px;
    }
    .email-container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .email-header {
      text-align: center;
      padding: 20px;
      /* background-color: #004aad; */
    }
    .email-header img {
      max-width: 140px;
    }
    .email-body {
      padding: 30px;
      color: #333;
    }
    h2 {
      color: #004aad;
      margin-top: 0;
    }
    .btn {
      display: inline-block;
      padding: 12px 24px;
      margin: 10px 5px;
      background-color: #0d6efd;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      font-weight: bold;
    }
    .table-section {
      margin-top: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      margin-top: 10px;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }
    table th {
      background-color: #f1f1f1;
    }
    .email-footer {
      text-align: center;
      background: #f8f9fa;
      padding: 20px;
      font-size: 13px;
      color: #666;
    }
    .social-icons img {
      width: 24px;
      margin: 0 6px;
    }
  </style>
</head>
<body>

<div class="email-container">
  <div class="email-header">
    <img src="img/leal_logo_half.jpg" alt="Leal Logo">
  </div>
  <div class="email-body">
    <h2>Hello {$user_id},</h2>
   <p>Hope you are doing well. This is a kind reminder that your <strong>Heat Load Calculator</strong> plan is set to expire on <strong>{$sub_end}</strong>. We recommend renewing your subscription in advance to ensure continued access to all tools and services.</p>

  <p>Renewing on time will help you maintain uninterrupted access to premium features, saved project data, and technical support. Thank you for choosing Leal Software — we look forward to assisting you with your HVAC calculation and design needs.</p>

    <div style="text-align:center;">
      <a href="https://lealsolution.com/payment-link?uid={$user_id}" class="btn" style="background-color:#009CFF; color:white";>Renew Now</a>
    </div>

    <div class="table-section">
      <h3 style="margin-bottom: 10px;">Available Plans</h3>
      <table>
        <tr>
          <th>S.No</th>
          <th>Type</th>
          <th>Name</th>
          <th>Duration</th>
          <th>Price</th>
          <th>Pay</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Demo</td>
          <td>Demo Sub</td>
          <td>15 Days</td>
          <td>₹2000 + 18% GST</td>
         <td>
          <a href="https://your-payment-link.com" target="_blank" title="Pay Now">
            <img src="https://cdn-icons-png.flaticon.com/512/126/126083.png" alt="Pay Icon" style="width:24px; height:24px;">
          </a>
        </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Yearly</td>
          <td>Yearly Sub</td>
          <td>365 Days</td>
          <td>₹32,000 + 18% GST</td>
          <td>
            <a href="https://your-payment-link.com" target="_blank" title="Pay Now">
              <img src="https://cdn-icons-png.flaticon.com/512/126/126083.png" alt="Pay Icon" style="width:24px; height:24px;">
            </a>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Yearly</td>
          <td>Yearly + BOQ</td>
          <td>365 Days</td>
          <td>₹32,000 + ₹18,000 + 18% GST</td>
          <td>
            <a href="https://your-payment-link.com" target="_blank" title="Pay Now">
              <img src="https://cdn-icons-png.flaticon.com/512/126/126083.png" alt="Pay Icon" style="width:24px; height:24px;">
            </a>
          </td>
        </tr>
        <tr>
          <td>4</td>
          <td>Lifetime</td>
          <td>Lifetime</td>
          <td>Unlimited</td>
          <td>₹1,12,000 + 18% GST</td>
          <td>
            <a href="https://your-payment-link.com" target="_blank" title="Pay Now">
              <img src="https://cdn-icons-png.flaticon.com/512/126/126083.png" alt="Pay Icon" style="width:24px; height:24px;">
            </a>
          </td>
        </tr>
        <tr>
          <td>5</td>
          <td>Lifetime</td>
          <td>Lifetime + BOQ</td>
          <td>Unlimited</td>
          <td>₹1,12,000 + ₹18,000 + 18% GST</td>
          <td>
            <a href="https://your-payment-link.com" target="_blank" title="Pay Now">
              <img src="https://cdn-icons-png.flaticon.com/512/126/126083.png" alt="Pay Icon" style="width:24px; height:24px;">
            </a>
          </td>
        </tr>
      </table>
    </div>
   <p>Thank you for being a valued user. We truly appreciate your continued trust and support.</p>
<p>Warm regards,<br><strong>Team Leal Software</strong></p>

  </div>
  <div class="email-footer">
    <div class="social-icons">
      <a href="https://www.linkedin.com/company/lealsolution"><img src="https://cdn-icons-png.flaticon.com/512/733/733561.png" alt="LinkedIn"></a>
      <a href="https://www.facebook.com/lealsolution"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
      <a href="https://www.instagram.com/lealsolution"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram"></a>
      <a href="https://wa.me/7410016111"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp"></a>
    </div>
    <p>
      621, Ventage Capital, Hinjewadi, Pune – 411057<br>
      📞 7410016111 | ✉️ info@lealsolution.com
    </p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Unsubscribe</a></p>
    <p>© 2025 Leal Software Solution Pvt Ltd. All rights reserved.</p>
  </div>
</div>

</body>
</html>
HTML;

    echo $email_html;

} else {
    echo "No users with upcoming subscription expirations found.";
}

function getUserName($conn, $user_id) {
    $res = $conn->query("SELECT name FROM users WHERE id = '$user_id' LIMIT 1");
    if ($res && $res->num_rows > 0) {
        return $res->fetch_assoc()['name'];
    }
    return "Subscriber";
}

$conn->close();
?>
