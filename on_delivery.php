<?php
include "db.php";


if(isset($_POST["submit"])){
    $user_id=$_POST['user_id'];
    $items=$_POST['order'];
    $total=$_POST['total_price'];
    $delivery_mode=$_POST['delivery'];
    $sql = "INSERT INTO orders (id_user,order_list,total,delivery_mode) VALUES ('$user_id','$items','$total','$delivery_mode')";
    $result=mysqli_query($con,$sql);
    if($result){
            // clearing the cart
            $ql_delete="DELETE  FROM cart WHERE user_id='$user_id'";
            $complete_delete=mysqli_query($con,$ql_delete);
            if($complete_delete){
            
               header('Location:success.php');
            }
            }else{
        header('Location:checkout.php');
    }
}else{
    header('Location:checkout.php');
}

?>