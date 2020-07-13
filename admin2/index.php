<?php
include("../db.php");
// order for payment on delivery by date 
$query="select date,SUM(total) as total_amt from orders group by dayofmonth(date)";
$result=mysqli_query($con,$query);
$chart_data ='';
while($row = mysqli_fetch_assoc($result))
{
 $chart_data .= "{ year:'".$row["date"]."', profit:".$row["total_amt"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
// orders for mobile money
$q="select date,SUM(total) as total_amt from mm_order group by dayofmonth(date)";
$res=mysqli_query($con,$q);
$mm_data ='';
while($row5 = mysqli_fetch_assoc($res))
{
 $mm_data .= "{ year:'".$row5["date"]."', profit:".$row5["total_amt"]."}, ";
}
$mm_data = substr($mm_data, 0, -2);

// count users in the system
$user_="select COUNT(*) as user_counts from user_info";
$user_result=mysqli_query($con,$user_);
$user_row=mysqli_fetch_array($user_result);
$count=$user_row['user_counts'];
$status1="Pending";
// checking fot pending orders
// orders from orders table
$sql_order = "select COUNT(*) as new_orders from orders where status='$status1'";
$order_query=mysqli_query($con,$sql_order);
$order_result=mysqli_fetch_array($order_query);
$order_count=$order_result['new_orders'];
// orders from mm_order
$sql_mm ="select COUNT(*)as mm_neworder from mm_order where status='$status1'";
$mm_query=mysqli_query($con,$sql_mm);
$mm_row=mysqli_fetch_array($mm_query);
$mm_count =$mm_row['mm_neworder'];
$total_orders=$order_count+$mm_count;
// Getting total amount from confirmed sales
$status2="Confirmed"; 
$direct_payment="select SUM(total) as direct_payment from orders where status='$status2'";
$direct_result=mysqli_query($con,$direct_payment);
$row2 = mysqli_fetch_assoc($direct_result);
// mobile money payment 
$mm_payment="select SUM(total) as mm_payment from mm_order where status='$status2'";
$mm_result=mysqli_query($con,$mm_payment);
$row3=mysqli_fetch_assoc($mm_result);
$sale=$row2['direct_payment']+$row3['mm_payment'];
// group sales by month 
$month_query="select MONTH(date) as mn_data,SUM(total) as total from orders group by month(date)";
$month_result=mysqli_query($con,$month_query);
$bar_chart ='';
while($row4 = mysqli_fetch_assoc($month_result))

{
  $bar_chart .= "{ month:'".$row4["mn_data"]."', sales:".$row4["total"]."}, ";
}
$bar_chart = substr($bar_chart, 0, -2);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Admin Panel</div>
      <div class="list-group list-group-flush" style="margin:10px;">
        <li><button style="width:240px; height:50px" type="button" class="btn btn-primary" onClick="location.href='index.php'"><span style="float:left;"><img src="./imgs/icons8-dashboard-50.png" style="height:30px; width: 30px;"></span> Dashboard </button></li> 

        <li><button style="width:240px; height:50px" type="button" class="btn btn-primary" onClick="location.href='customers.php'"><span style="float:left;"><img src="./imgs/icons8-group-50.png"  style="height:30px; width: 30px;"></span> Customers </button></li>
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
        <br />
        <div class="row">
          <div class="col-lg-4">
            <div class="card text-white bg-primary mb-3">
            <div class="card-body">
              <h5 class="card-title">Total Income</h5>
              <h6 class="card-subtitle mb-2 ">Treasury</h6>
              <p class="card-text">UGX <?php echo $sale ;?></p>
              
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card text-white bg-warning mb-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Total Users</h5>
              <h6 class="card-subtitle mb-2">Overall</h6>
              <p class="card-text"><?php echo $count ;?> People</p>
            </div>
          </div>
      </div>
      <div class="col-lg-4">
        <div class="card text-white bg-success mb-3" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">New Orders</h5>
            <h6 class="card-subtitle mb-2">Mobile & Direct</h6>
            <p class="card-text"><?php echo $total_orders; ?></p>
            
          </div>
      </div>
    </div>
</div>
<hr />
<div class="row">
  <div class="col-lg-6">
  <div class="panel panel-default">
  <div class="panel-heading">Payment on Delivery
  <div class="panel-body">
  <!-- bar chart -->
  <div id="chart" style="height:300px;"></div>
  </div>
  </div>
  </div>
  </div>
  <div class="col-lg-6">
  <div class="panel panel-default">
  <div class="panel-heading">Mobile Money
  <div class="panel-body">
  <!-- bar chart -->
  <div id="chart2" style="height:300px;"></div>
  </div>
  </div>
  </div>
  </div>
</div>
<hr />
<div class="row">
<h3>Monthly Chart</h3>
<div class="col-lg-12">
  <div id="barLine"></div>
</div>

</div>
<?php  //success message
if(isset($_POST['success'])) {
$success = $_POST["success"];
echo "<h1 style='color:#0C0'>Your Product was added successfully &nbsp;&nbsp;  <span class='glyphicon glyphicon-ok'></h1></span>";
}
?>
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
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'year',
 ykeys:['profit'],
 labels:['Profit'],
 xLabelAngle:45,
 barSize:50,
 hideHover:'auto',
 resize:true,
 stacked:true
});
Morris.Bar({
 element : 'chart2',
 data:[<?php echo $mm_data; ?>],
 xkey:'year',
 ykeys:['profit'],
 labels:['Profit'],
 xLabelAngle:45,
 barSize:50,
 hideHover:'auto',
 resize:true,
 stacked:true
});
Morris.Bar({
 element : 'barLine',
 data:[<?php echo $bar_chart; ?>],
 xkey:'month',
 ykeys:['sales'],
 labels:['sales'],
 hideHover:'auto',
 barSize:50,
 resize:true,
 stacked:true
});

</script>