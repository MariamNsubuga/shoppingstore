<?php
include_once("connect.php");
session_start();
$query1=mysqli_query($con,"select * from Users where email='".$_SESSION['username']."' ");
 $query1_row=mysqli_fetch_array($query1);
 $user_id=$query1_row['user_id'];
if(isset($_POST['submit'])){
    $order_status=$_POST["status"];
    $sql="update cart_items set user_status='".$order_status."' where user_id='".$user_id."'";
    $order=mysqli_query($con,$sql);

}
?>