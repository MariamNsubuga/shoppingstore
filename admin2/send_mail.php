<?php
include("../db.php");
if(isset($_POST['submit'])){
    $status="Confirmed";
    $customer_email=$_POST['email'];
    $order_id=$_POST['mm_id'];
    $value=$_POST['mm_value'];
    $message=$_POST['message'];
  
    $to = $customer_email;
    $subject="Order";
    $email_message="<h1>Hey there!</h1>
    <p>You have received this mail because your order has been received!</p>
    <p>Your order is:".$message."</p>
    <p>You will receive a phone call from :+256705451834</p>
    <p>Thank you!!</p>
    ";
    // Headers
    $headers="From:The Sender Name<kigaye.ericpter@gmail.com>\r\n";
    $headers.="Reply-To:kigaye.ericpeter@gmail.com\r\n";
    $headers.="Content-type:text/html\r\n";
    if($value==1){
        $sql_mm="UPDATE mm_order status=$status WHERE order_id='$order_id'";
        mysqli_query($con,$sql_mm);
        mail($to,$subject,$email_message,$headers);
        header('Location:mm_orders.php');
    }elseif ($value ==2) {
        # code...
        $sql_dd="UPDATE orders status=$status WHERE order_id='$order_id'";
        mysqli_query($con,$sql_dd);
         mail($to,$subject,$email_message,$headers);
         header('Location:orders.php');
    }
    else{
        header('Location:index.php');
    }
  
    
  }
// // recipient
// $to ='tobiusaolo21@gmail.com';
// // subject
// $subject='This is CWI Order';
// // Message
// $message = '<h1>Hi there.</h1><p>Thanks for testing</p>';
// // Headers
// $headers="From:The Sender Name<sender@johnmorrisonline.com>\r\n";
// $headers.="Reply-To:kigaye.ericpeter@gmail.com\r\n";
// $headers.="Content-type:text/html\r\n";

// // send mail
// mail($to,$subject,$message,$headers);