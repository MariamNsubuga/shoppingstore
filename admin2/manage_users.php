<?php

include("../db.php");
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$user_id=$_GET['user_id'];

/*this is delet quer*/
mysqli_query($con,"delete from user_info where user_id='$user_id'")or die("query is incorrect...");
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
        <button class="btn btn-primary" id="menu-toggle">View Full Screen</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

       
      </nav>

      <div class="container-fluid">
        <div class="panel-heading" style="background-color:#c4e17f">
  <h1>Manage User </h1></div><br>

<div style="overflow-x:scroll;">
<table class="table table-bordered table-hover table-striped" style="font-size:15px">
  <tr>
          <th>User Name</th>
                <th>User Password</th>
  <th><a href="add_user.php">Add New</a></th></tr>  
<?php 
$result=mysqli_query($con,"select user_id, email, password from user_info")or die ("query 2 incorrect.......");

while(list($user_id,$user_name,$user_password)=
mysqli_fetch_array($result))
{
echo "<tr><td>$user_name</td><td>$user_password</td>";

echo"<td>
<a href='edit_user.php?user_id=$user_id'>Edit</a>
<a href='manage_users.php?user_id=$user_id&action=delete'>Delete</a>
</td></tr>";
}
mysqli_close($con);
?>
</table>
</div>  
</div></div>
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
