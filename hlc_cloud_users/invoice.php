<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
  <!-- Font Stylesheet Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
 
  <style>
    body {
      max-width: 700px;
      margin: 40px auto;
      border: 2px solid #00000087;
      border-radius: 6px;
      padding: 20px 40px;
      color: #333;
      font-family:'Montserrat', sans-serif;
    }
    th {
      background-color: #2964a1 !important;
      color: #fff !important;
    }
 
    .table-horizontal-only td,
    .table-horizontal-only th {
      border-left: none !important;
      border-right: none !important;
    }
 
    .table-horizontal-only {
      border-left: none !important;
      border-right: none !important;
    }
  </style>
</head>
<body>
 
  <!-- Header Logo -->
  <div class="text-center mb-5">
    <img src="img/leal_logo_half.jpg" class="img-fluid" style="max-width: 140px;" alt="Logo">
  </div>
 
  <!-- Invoice Header -->
  <div class="d-flex justify-content-between border-bottom pb-3 mb-4">
    <div></div>
    <div class="text-end">
      <h2 class="mb-2 fw-bold">INVOICE</h2>
      <p class="mb-1"><strong>Invoice ID:</strong> #1234567890</p>
      <p class="mb-0"><strong>Invoice Date:</strong> 10/07/2025</p>
    </div>
  </div>
 
  <!-- Invoice To -->
  <div class="row mb-4">
    <div class="col-sm-6">
      <h5 class="mb-2 fw-bold">INVOICE TO</h5>
      <p class="mb-1 ">Subodh Murkewar</p>
      <p class="mb-0">+91 7410016111</p>
    </div>
    <div class="col-sm-6 text-sm-end pt-4">
      <p class="mb-1">heatload@lealsolution.com</p>
      <p class="mb-0">123 Green Life society, Pune</p>
    </div>
  </div>
 
  <!-- Invoice Table -->
  <table class="table table-bordered table-horizontal-only align-middle">
    <thead>
      <tr>
        <th>PRODUCT</th>
        <th class="text-end">PRICE</th>
        <th class="text-end">QTY</th>
        <th class="text-end">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Logo Design</td>
        <td class="text-end">&#8377; 100.00</td>
        <td class="text-end">1</td>
        <td class="text-end">&#8377; 100.00</td>
      </tr>
      <tr>
        <td>Business Magazine Design</td>
        <td class="text-end">&#8377; 60.00</td>
        <td class="text-end">2</td>
        <td class="text-end">&#8377; 120.00</td>
      </tr>
      <tr>
        <td>Business Card</td>
        <td class="text-end">&#8377; 125.00</td>
        <td class="text-end">1</td>
        <td class="text-end">&#8377; 125.00</td>
      </tr>
      <tr>
        <td>Website Page</td>
        <td class="text-end">&#8377; 30.00</td>
        <td class="text-end">4</td>
        <td class="text-end">&#8377; 120.00</td>
      </tr>
    </tbody>
  </table>
 
    <!-- Total -->
    <div class="row mt-4">
      <!-- Terms and Conditions (Left) -->
      <div class="col-md-7">
        <h6 class="fw-bold mb-2">Terms and Conditions:</h6>
        <ul class="mb-0 small">
          <li>Payment is due upon receipt of this invoice.</li>
          <li>Late payments may incur additional charges.</li>
          <li>Please make checks payable to Your Graphic Design Studio.</li>
        </ul>
      </div>
 
      <!-- Total (Right) -->
      <div class="col-md-5">
        <table class="table">
          <tr>
            <th><strong>TOTAL</strong></td>
            <th class="text-end"><strong>&#8377; 558.00</strong></td>
          </tr>
        </table>
      </div>
    </div>  
 
  <!-- Footer -->
  <div class="mt-5">
    <p class="fst-italic">Thank you for subscribing!</p>
    <p class="fw-bold text-end mt-4">Heatload Calculator</p>
  </div>
 
</body>
</html>