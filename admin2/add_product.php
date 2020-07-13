<?php

include("../db.php");
session_start();


if(isset($_POST['submit']))
{
$product_name=mysqli_real_escape_string($con,$_POST['product_name']);
$details=mysqli_real_escape_string($con,$_POST['details']);
$price=mysqli_real_escape_string($con,$_POST['price']);
// $c_price=$_POST['c_price'];
$product_type=mysqli_real_escape_string($con,$_POST['product_type']);
$brand=mysqli_real_escape_string($con,$_POST['brand']);
$tags=mysqli_real_escape_string($con,$_POST['tags']);

//picture coding
$picture_name=$_FILES['picture']['name'];
$picture_type=$_FILES['picture']['type'];
$picture_tmp_name=$_FILES['picture']['tmp_name'];
$picture_size=$_FILES['picture']['size'];

if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
{
  if($picture_size<=50000000)
  
    $pic_name=time()."_".$picture_name;
    move_uploaded_file($picture_tmp_name,"../product_images/".$pic_name);
$query ="INSERT INTO products(product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) 
 VALUES('$product_type','$brand','$product_name','$price','$details','$pic_name','$tags')";
mysqli_query($con,$query) or die ("query incorrect");

 header("location: sumit_form.php?success=1");
}

mysqli_close($con);
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
        <div class="panel panel-default">
  <div class="panel-heading" style="background-color:#c4e17f">
  <h1><span class="glyphicon glyphicon-tag"></span> Product / Add Product  </h1></div><br>
  <div class="panel-body" style="background-color:#E6EEEE;">
    <div class="col-lg-12">
        <div class="well">
        <form action="add_product.php" method="post" name="form" enctype="multipart/form-data">
        <p>Title</p>
        <input class="input-lg thumbnail form-control" type="text" name="product_name" id="product_name" autofocus style="width:100%" placeholder="Product Name" required>
    <p>Description</p>
    <textarea class="thumbnail form-control" name="details" id="details" style="width:100%; height:100px" placeholder="write here..." required></textarea>
<p>Add Image</p>
<div style="background-color:#CCC">
<input type="file" style="width:100%" name="picture" class="btn thumbnail" id="picture" >
</div>
</div>
<div class="well">
<h3>Pricing</h3>
<p>Price</p>
<div class="input-group">
      <div class="input-group-addon">UGX</div>
      <input type="text" class="form-control" name="price" id="price"  placeholder="0.00" required>
    </div><br>


    </div>
        </div>  
        <div class="col-lg-12">
        <div class="well">
<h3>Category</h3>  
<p>Product type</p>
<input type="number" name="product_type" id="product_type" class="form-control" placeholder="1 Birds,2 Craft , 3 Poultry_Products" >
<br>
<p>Vendor / Brand</p>
<input type="number" name="brand" id="brand" class="form-control" placeholder="1 Birds , 2 Craft , 3 Poultry">
<br>
<p>Other tags</p>
<input type="text" name="tags" id="tags" class="form-control">
</div>          
</div>
<br />
<div align="center">
    <button type="submit" name="submit" id="submit" class="btn btn-danger" style="width:100px; height:60px"> Cancel</button>
    <button type="submit" name="submit" id="submit" class="btn btn-success" style="width:150px; height:60px"> Add Product</button>
    </div>
</form>
 
  </div>
</div></div></div>
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
