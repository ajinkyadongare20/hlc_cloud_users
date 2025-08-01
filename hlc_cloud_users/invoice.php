<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice | Leal Solutions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Font Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary-color: #2964a1;
      --secondary-color: #f8f9fa;
      --accent-color: #e9ecef;
      --text-color: #343a40;
      --light-text: #6c757d;
      --border-color: #dee2e6;
    }
    
    body {
      max-width: 100%;
      margin: 0px 300px !important;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      padding: 0;
      color: var(--text-color);
      font-family: 'Montserrat', sans-serif;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      height: auto !important;
    }
    
    .invoice-container {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .invoice-header {
      background-color: var(--primary-color);
      color: white;
      padding: 30px 40px;
      position: relative;
      overflow: hidden;
      flex-shrink: 0;
    }
    
    .invoice-header::before {
      content: "";
      position: absolute;
      top: -50px;
      right: -50px;
      width: 150px;
      height: 150px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
    }
    
    .invoice-header::after {
      content: "";
      position: absolute;
      bottom: -80px;
      right: -30px;
      width: 200px;
      height: 200px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 50%;
    }
    
    .company-name {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: 0.5px;
    }
    
    .invoice-title {
      font-family: 'Playfair Display', serif;
      font-weight: 600;
      font-size: 2.2rem;
      letter-spacing: 1px;
      margin-bottom: 0;
    }
    
    .invoice-body {
      padding: 40px;
      flex: 1;
      overflow-y: auto;
    }
    
    .section-title {
      font-weight: 600;
      color: var(--primary-color);
      border-bottom: 2px solid var(--primary-color);
      padding-bottom: 8px;
      margin-bottom: 20px;
      font-size: 1.1rem;
      letter-spacing: 0.5px;
    }
    
    .client-info p, .company-info p {
      margin-bottom: 5px;
    }
    
    .client-name {
      font-weight: 600;
      font-size: 1.2rem;
      color: var(--primary-color);
    }
    
    .table {
      margin-top: 30px;
      border-collapse: separate;
      border-spacing: 0;
    }
    
    .table thead th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 500;
      padding: 12px 15px;
      border: none;
    }
    
    .table tbody td {
      padding: 15px;
      border-bottom: 1px solid var(--border-color);
      vertical-align: middle;
    }
    
    .table tbody tr:last-child td {
      border-bottom: none;
    }
    
    .total-table {
      width: 100%;
      max-width: 300px;
      margin-left: auto;
    }
    
    .total-table td {
      padding: 10px 15px;
      border-bottom: 1px solid var(--border-color);
    }
    
    .total-table tr:last-child td {
      font-weight: 600;
      color: var(--primary-color);
      border-bottom: none;
      font-size: 1.1rem;
    }
    
    .terms-box {
      background-color: var(--secondary-color);
      border-left: 4px solid var(--primary-color);
      padding: 15px;
      margin-top: 30px;
    }
    
    .terms-title {
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--primary-color);
    }
    
    .terms-list {
      padding-left: 20px;
      margin-bottom: 0;
    }
    
    .terms-list li {
      margin-bottom: 5px;
      font-size: 0.9rem;
      color: var(--light-text);
    }
    
    .footer {
      background-color: var(--secondary-color);
      padding: 20px 40px;
      text-align: center;
      font-size: 0.9rem;
      color: var(--light-text);
      border-top: 1px solid var(--border-color);
      flex-shrink: 0;
    }
    
    .thank-you {
      font-style: italic;
      color: var(--primary-color);
      font-weight: 500;
    }
    
    .signature {
      margin-top: 50px;
      text-align: right;
    }
    
    .signature-line {
      border-top: 1px solid var(--border-color);
      width: 200px;
      display: inline-block;
      margin-top: 50px;
    }
    
    .signature-text {
      margin-top: 5px;
      font-weight: 600;
      color: var(--primary-color);
    }
    
    .badge {
      background-color: rgba(41, 100, 161, 0.1);
      color: var(--primary-color);
      font-weight: 500;
      padding: 5px 10px;
      border-radius: 4px;
    }
    
    .text-accent {
      color: var(--light-text);
    }
    
    .text-primary {
      color: var(--primary-color) !important;
    }
    
    .logo-container {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .logo-img {
      height: 50px;
    }
    
    .invoice-meta {
      display: flex;
      justify-content: space-between;
      margin-top: 15px;
    }
    
    .meta-item {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .meta-icon {
      font-size: 1rem;
    }
    
    /* Ensure the body doesn't scroll */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    
    .plan-name {
      font-weight: 600;
      color: var(--primary-color);
    }
    
    .plan-duration {
      font-size: 0.85rem;
      color: var(--light-text);
    }
  </style>
</head>
<body>
  <div class="invoice-container">
    <!-- Header with Company Info -->
    <div class="invoice-header">
      <div class="logo-container">
        <img src="img/leal_logo_half.jpg" class="logo-img" alt="Leal Solutions Logo">
        <div>
          <div class="company-name">LEAL SOFTWARE SOLUTIONS PVT LTD</div>
          <div class="text-white-50" style="font-size: 0.9rem;">Innovative Solutions for a Digital World</div>
        </div>
      </div>
      
      <div class="d-flex justify-content-between align-items-end mt-4">
        <div>
          <div><i class="fas fa-map-marker-alt meta-icon"></i> 621, Ventage Capital, Hinjewadi, Pune – 411057</div>
          <div class="mt-1"><i class="fas fa-phone meta-icon"></i> +91 7410016111/13/14</div>
          <div class="mt-1"><i class="fas fa-envelope meta-icon"></i> info@lealsolution.com</div>
        </div>
        <h1 class="invoice-title">INVOICE</h1>
      </div>
      
      <div class="invoice-meta text-white-50" style="font-size: 0.9rem;">
        <div class="meta-item">
          <i class="fas fa-file-invoice meta-icon"></i>
          <span>INV-2025-00742</span>
        </div>
        <div class="meta-item">
          <i class="fas fa-calendar-alt meta-icon"></i>
          <span>July 10, 2025</span>
        </div>
        <div class="meta-item">
          <i class="fas fa-barcode meta-icon"></i>
          <span>PAY-742-925</span>
        </div>
      </div>
    </div>
    
    <!-- Invoice Body (Scrollable Content) -->
    <div class="invoice-body">
      <!-- Client and Company Info -->
      <div class="row mb-5">
        <div class="col-md-6">
          <div class="section-title">BILL TO</div>
          <div class="client-info">
            <p class="client-name">Subodh Murkewar</p>
            <p class="text-accent">Heatload Calculator</p>
            <p>+91 7410016111</p>
            <p>heatload@lealsolution.com</p>
            <p>123 Green Life society, Pune</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="section-title">COMPANY</div>
          <div class="company-info">
            <p><strong>Leal Solutions Pvt. Ltd.</strong></p>
            <p>GSTIN: 27ABCDE1234F1Z5</p>
            <p>PAN: ABCDE1234F</p>
            <p>Account No: 1234567890</p>
            <p>IFSC: LEAL0000123</p>
          </div>
        </div>
      </div>
      
      <!-- Invoice Items Table -->
      <div class="section-title">SUBSCRIPTION PLANS</div>
      <table class="table">
        <thead>
          <tr>
            <th>PLAN TYPE</th>
            <th>DETAILS</th>
            <th class="text-end">DURATION</th>
            <th class="text-end">AMOUNT</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="plan-name">Demo Plan</td>
            <td>Demo Sub</td>
            <td class="text-end plan-duration">15 Days</td>
            <td class="text-end">₹2,000 + 18% GST</td>
          </tr>
          <tr>
            <td class="plan-name">Yearly Plan</td>
            <td>Yearly Sub</td>
            <td class="text-end plan-duration">365 Days</td>
            <td class="text-end">₹32,000 + 18% GST</td>
          </tr>
          <tr>
            <td class="plan-name">Yearly Plan</td>
            <td>Yearly + BOQ</td>
            <td class="text-end plan-duration">365 Days</td>
            <td class="text-end">₹50,000 + 18% GST</td>
          </tr>
          <tr>
            <td class="plan-name">Lifetime Plan</td>
            <td>Lifetime</td>
            <td class="text-end plan-duration">Unlimited</td>
            <td class="text-end">₹1,12,000 + 18% GST</td>
          </tr>
          <tr>
            <td class="plan-name">Lifetime Plan</td>
            <td>Lifetime + BOQ</td>
            <td class="text-end plan-duration">Unlimited</td>
            <td class="text-end">₹1,30,000 + 18% GST</td>
          </tr>
        </tbody>
      </table>
      
      <!-- Selected Plan Details -->
      <div class="section-title mt-5">SELECTED PLAN</div>
      <table class="table">
        <thead>
          <tr>
            <th>PLAN</th>
            <th>DETAILS</th>
            <th class="text-end">DURATION</th>
            <th class="text-end">AMOUNT</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="plan-name">Yearly</td>
            <td>Yearly + BOQ</td>
            <td class="text-end plan-duration">365 Days</td>
            <td class="text-end">₹50,000</td>
          </tr>
        </tbody>
      </table>
      
      <!-- Totals and Terms -->
      <div class="row mt-4">
        <div class="col-md-7">
          <div class="terms-box">
            <div class="terms-title">PAYMENT TERMS</div>
            <ul class="terms-list">
              <li>Payment is due within 15 days of invoice date</li>
              <li>Please include invoice number with your payment</li>
              <li>Late payments are subject to 1.5% monthly interest</li>
              <li>Make checks payable to Leal Solutions Pvt. Ltd.</li>
              <li>Bank transfer details provided above</li>
            </ul>
          </div>
          
          <div class="mt-3">
            <span class="badge"><i class="fas fa-info-circle"></i> All amounts in Indian Rupees (INR)</span>
          </div>
        </div>
        
        <div class="col-md-5">
          <table class="total-table">
            <tr>
              <td>Subtotal</td>
              <td class="text-end">₹50,000.00</td>
            </tr>
            <tr>
              <td>Tax (GST 18%)</td>
              <td class="text-end">₹9,000.00</td>
            </tr>
            <tr>
              <td>Discount</td>
              <td class="text-end">-₹0.00</td>
            </tr>
            <tr>
              <td><strong>Total Due</strong></td>
              <td class="text-end"><strong>₹59,000.00</strong></td>
            </tr>
          </table>
        </div>
      </div>
      
      <!-- Signature -->
      <div class="signature">
        <div class="signature-line"></div>
        <div class="signature-text">Authorized Signature</div>
      </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
      <div class="thank-you mb-2">Thank you for your business!</div>
      <div>
        <i class="fas fa-phone text-primary"></i> +91 7410016111/13/14 &nbsp; | &nbsp;
        <i class="fas fa-envelope text-primary"></i> accounts@lealsolution.com &nbsp; | &nbsp;
        <i class="fas fa-globe text-primary"></i> www.lealsolution.com
      </div>
      <div class="mt-2 small">This is a computer generated invoice and does not require a physical signature</div>
    </div>
  </div>
</body>
</html>