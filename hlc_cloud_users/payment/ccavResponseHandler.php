

<?php include('Crypto.php')?>
<?php

	error_reporting(0);
	$workingKey='64107A43D8D73ABB08E4CD2E5889210C';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	$merchant_param1 = "";
	$merchant_param2 = "";
	$payment_status = "";
// 	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3){$order_status=$information[1];}
		if($i==26){ $merchant_param1=$information[1]; }
		if($i==27){ $merchant_param2=$information[1]; }
	}

	if($order_status==="Success")
	{
	    $payment_status = '4';
// 		echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		
	}
	else if($order_status==="Aborted")
	{
	    $payment_status = '2';
// 		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
	    $payment_status = '3';
// 		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
// 		echo "<br>Security Error. Illegal access detected";
	
	}


    
    
$url="https://be.tasktrakhub.com/api/update/transactionData";
$post = [
     "randam_number"=>$merchant_param2,
    "payment_status"=>$payment_status
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
$headers = array();
$headers[] = 'Authorization: Bearer '.$merchant_param1;
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$result = json_decode($result,true);
if($result["Status"]){
    //echo "<pre>";
    //print_r($result['Data']['request_data']);
}else{
    if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    }else{
      echo "Something Went wrong";   
    }
}
curl_close($ch);



// 	echo "<table cellspacing=4 cellpadding=4>";
// 	for($i = 0; $i < $dataSize; $i++) 
// 	{
// 		$information=explode('=',$decryptValues[$i]);
// 	    	echo '<tr><td>'.$information[0].'</td><td>'.urldecode($information[1]).'</td></tr>';
// 	}

// 	echo "</table><br>";
	echo "</center>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Success Modal</title>
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
</head>
<body>
<!-- Modal -->
<?php if($order_status==="Success"){ ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="succesful_symbol"><i class="fa-solid fa-circle-check"></i></div>
        <h5 class="modal-title" id="paymentModalLabel">Your payment was successful</h5>
        <p>Thank you for your payment. We will be in contact with more details shortly.</p>
      </div>
    </div>
  </div>
</div>
<?php } else{ ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="cancel_succesful_symbol"><i class="fa-solid fa-circle-exclamation"></i></div>
        <h5 class="modal-title" id="paymentModalLabel">Your payment failed</h5>
        <p>Please try again</p>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript to automatically open the modal -->
<script>
  // Automatically open the modal when the page loads
  window.addEventListener('DOMContentLoaded', (event) => {
    var modalElement = document.getElementById('exampleModal');
    var modalInstance = new bootstrap.Modal(modalElement);
    modalInstance.show();
    setTimeout(function () {
      modalInstance.hide();
      window.close();
    }, 4000);
    
  });
  
    setTimeout(function () {
    // var location = "https://www.lealsolution.com/Sample_Website/cc-avenue/payment/ccavResponseHandler.php?data=hskjhd"; 
    //  window.open(location, '_self').close();
      window.close();
    }, 4000);
</script>

<?php    
  
   // echo "<script>window.close();</script>";
?>
</body>
</html>
