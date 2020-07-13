<?php  
//connecting database
include "db.php";
//Testing Mobile money incoming 
if(isset($_POST['submit'])){
 $client_id="09f5b388c45fdb53";
 $secrete_id="59d0afda31b2175a";
 $amount=$_POST["total_price"];
 $phone=$_POST["contact"];
 $user=$_POST["user"];
 $order=$_POST["order"];
 $amt=$_POST["total_price"];
 $status="Pending";
 //creating reference number randomly
   $length = 4;
    $ref = '';
    for ($i=0;$i<$length;$i++){
        $ref .= rand(1, 9);

    }
 
 $url='https://www.easypay.co.ug/api/'; 
 $payload = array( 'username' => $client_id, 
 'password' => $secrete_id, 
 'action' => 'mmdeposit', 
 'amount' => $amount, 
 'phone'=>$phone, 
 'currency'=>'UGX', 
 'reference'=>$ref, 
 'reason'=>'Testing MM DEPOSIT' 
 ); 
  
 //open connection 
 $ch = curl_init(); 
  
 //set the url, number of POST vars, POST data 
 curl_setopt($ch,CURLOPT_URL, $url); 
 curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($payload)); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,15); 
 curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in seconds 
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
 //execute post 
 $result = curl_exec($ch); 
  
 //close connection 
 curl_close($ch); 
//  print_r(json_decode($result)); 
//  Add data to database after payment
$sql = "INSERT INTO mm_order (id_user,order_list,total,sender_number,status) VALUES ('$user','$order','$amt','$phone','$status')";
$result=mysqli_query($con,$sql);
	if($result){
	// clearing the cart
            $ql_delete="DELETE  FROM cart WHERE user_id='$user_id'";
            $complete_delete=mysqli_query($con,$ql_delete);
            if($complete_delete){
            
               header('Location:success.php');
			}else{
				header('Location:checkout.php');
			}

	}else{
  			header('Location: checkout.php');
	}
}else{
	header('Location:checkout.php');
}
 ?> 
