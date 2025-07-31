<?php 

$paymentArray = array(
  "amount"=>1,
  "user"=>"Suraj",
  "randam_number"=>123456,
  "id"=>23
);

// Create New DB Table and Insert new record

$request_data = base64_encode(json_encode($paymentArray));
$request_data=base64_decode($request_data);
$request_data=json_decode($request_data,true);
$amount = $request_data['amount'];
$user = $request_data['user'];
$randam_number = $request_data['randam_number'];
$token = $request_data['id'];
$currency ='INR';
$allow_payment = true;
if($currency != 'INR'){
$allow_payment= false;    
}

die;
?>
<html>
<head>
<title>CC Avenue</title>
</head>
<body>
<center>
<?php include('Crypto.php')?>
<?php 
	error_reporting(0);
	$merchant_data='';
	$working_key='64107A43D8D73ABB08E4CD2E5889210C';//Shared by CCAVENUES
	$access_code='AVCD42KL57BO24DCOB';//Shared by CCAVENUES
	$array = array();
  	$array['tid'] =  $token;
    $array['merchant_id'] = "3117339";
    $array['order_id'] = "123654789";
    $array['amount'] = $amount;
    $array['currency'] = "INR";
    $array['merchant_param1'] = $randam_number;
    $array['merchant_param2'] = $token;
    
    $array['redirect_url'] = "https://www.lealsolution.com/Sample_Website/cc-avenue/payment/ccavResponseHandler.php";
    $array['cancel_url'] = "https://www.lealsolution.com/Sample_Website/cc-avenue/payment/ccavResponseHandler.php";
    
	foreach ($array as $key => $value){
		$merchant_data.=$key.'='.urlencode($value).'&';
	}
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
if($allow_payment){
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
}
?>
</form>
</center>
<?php if($allow_payment){ ?>
<script language='javascript'>document.redirect.submit();</script>
<?php } ?>


<?php if($allow_payment==false){ ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="cancel_succesful_symbol"><i class="fa-solid fa-circle-exclamation"></i></div>
        <h5 class="modal-title" id="paymentModalLabel">As of now, we are accepting payments only through www.tasktrakhub.in. Thank you for your understanding!</h5>
        <!--<p>Please try again</p>-->
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript to automatically open the modal -->
<script>
  window.addEventListener('DOMContentLoaded', (event) => {
    var modalElement = document.getElementById('exampleModal');
    var modalInstance = new bootstrap.Modal(modalElement);
    modalInstance.show();
  
    
  });

</script>

<?php } ?>
</body>


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 6.5.1 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    .modal-body {
    text-align: center;
    padding: 0px 30px 30px;
}
.modal-backdrop {
            background-color: rgb(0, 0, 0);
        }
    .succesful_symbol {
    color: #35b729;
}
.succesful_symbol i {
    font-size: 110px;
}
.cancel_succesful_symbol {
    color: #b50002;
}
.cancel_succesful_symbol i {
    font-size: 110px;
}
/* .modal-dialog {
        max-width: 630px;
        margin: 1.75rem auto;
    } */
    .modal-body img {
      width: 100px;
      height: 100px;
      margin-bottom: 20px;
    }
    .modal-body h5 {
    font-size: 30px;
    color: #333;
    /* font-weight: bold; */
}
.modal-body p {
    font-size: 25px;
    color: #555;
}
    .close-btn-left {
      position: absolute;
      top: 10px;
      left: 10px;
      font-size: 1.5rem;
      color: #000;
      background: none;
      border: none;
      cursor: pointer;
    }
    .modal-header {
    border-bottom: none;
    padding: 30px 30px 10px;
}
@media (min-width: 576px) {
    .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
    }
}
  </style>
  
</html>

