<?php

include("../db.php");
error_reporting(0);
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$order_id=$_GET['order_id'];

/*this is delet query*/
mysqli_query($con,"delete from orders where order_id='$order_id'")or die("delete query is incorrect...");
} 

///pagination
$page=$_GET['page'];

if($page=="" || $page=="1")
{
$page1=0; 
}
else
{
$page1=($page*10)-10; 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CWI</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Admin Panel</div>
      <div class="list-group list-group-flush" style="margin:10px;">
        <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='index.php'"><span style="float:left;"><img src="./imgs/icons8-dashboard-50.png" style="height:30px; width: 30px;"></span> Dashboard </button></li> 

        <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='customers.php'"><span style="float:left;"><img src="./imgs/icons8-group-50.png"  style="height:30px; width: 30px;"></span> Customers </button></li>
        <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='mm_orders.php'"> <span style="float:left;"><img src="./imgs/icons8-received-64.png" style="height:30px; width: 30px;"></span> Mobile Money Orders </button></li>
          <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='orders.php'"> <span style="float:left;"><img src="./imgs/icons8-delivery-26.png" style="height:30px; width: 30px;"></span> Delivery Payment Orders </button></li>
          <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='mm_transcations.php'"> <span style="float:left;"><img src="./imgs/icons8-online-shopping-128.png" style="height:30px; width: 30px;" ></span>Mobile Money Transactions </button></li>
          <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='delivery_transcations.php'"> <span style="float:left;"><img src="./imgs/icons8-cash-on-delivery-80.png" style="height:30px; width: 30px;"></span>Delivery Transactions </button></li>
          <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='add_product.php'"> <span style="float:left;" ><img src="./imgs/icons8-new-copy-26.png" style="height:30px; width: 30px;"></span> Add Product </button></li>
          <li>
          <button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='clothes_list.php'">
          <span style="float:left;"><img src="./imgs/icons8-product-80.png" style="height:30px; width: 30px;"></span>  Products  Lists</button>
          </li>

        

        <li><button style="width:240px; height:50px" type="button" class="btn btn-default btn-primary" onClick="location.href='manage_users.php'"> <span style="float:left;"><img src="./imgs/icons8-user-folder-26.png" style="height:30px; width: 30px;"></span> Manage Users </button></li> 
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">VIEW FULL SCREEN</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

       
      </nav>

      <div class="container-fluid">
        <div class="panel-heading" style="background-color:#c4e17f">
  <h1>Mobile Money Orders  / Page <?php echo $page;?> </h1></div><br>
<div class='table-responsive'>  
<div style="overflow-x:scroll;">
<table class="table  table-hover table-striped" style="font-size:15px">
<tr><th>Customer Name</th><th>Order</th><th>Contact | Email</th><th>Address</th><th>Amount</th><th>Sender Number</th><th>Time</th><th>Action</th><th></th></tr>
<?php 


$result=mysqli_query($con,"select id_user, order_list,total,sender_number,date, first_name,last_name, mobile, email, address1, address2 from mm_order,user_info where user_info.user_id=mm_order.id_user Limit $page1,10")or die ("query 1 incorrect.....");

while(list($order_id,$order_list,$total,$sender_number,$date,$firstname,$lastname,$mobile,$email,$address1,$address2)=mysqli_fetch_array($result))
{ 
  $order=explode(',',$order_list);
  
   
  
  
echo "<tr><td>$firstname $lastname</td><td>$order_list</td><td>$mobile<br>$email</td><td>$address1<br>$address2</td><td>$total</td><td> $sender_number</td><td>$date</td>

<td>
<a class=' btn btn-success' href='orders.php?order_id=$order_id&action=delete'>Delete</a>
</td>
<td>
<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter'>
  View
</button>
<div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLongTitle'>Customer Order</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body text-center'>
        Name of Customer:$firstname $lastname<br />
        Email:$email<br />
        Tel:$mobile<br />
        Adress:$address1,$address2 <br />
        <u><h4 class='h4'>Items Ordered</h4></u>";
        for($i=0;$i<count($order);$i++){
        echo $order[$i]."<br />";
        }
        echo "Amount:UGX $total
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>

        <form method='post' action='send_mail.php'>
        <input type='hidden' name='mm_id' value='".$order_id."'>
        <input type='hidden' name='mm_value' value=1>
        <input type='hidden' name='email' value='".$email."'>
        <input type='hidden' name='message' value='".$order_list."'>
        <input type='submit' name='submit' value ='Confirm Order' class='btn btn-primary'>
        </form>
      </div>
    </div>
  </div>
</div>
</td>
</tr>";
  
}
?>
</table>
</div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
