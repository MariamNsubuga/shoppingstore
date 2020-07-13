<?php
include "db.php";

include "header.php";


                         
?>

<style>

.row-checkout {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container-checkout {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.checkout-btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.checkout-btn:hover {
  background-color: #45a049;
}



hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row-checkout {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>

					
<section class="section">       
	<div class="container-fluid">
		<div class="row-checkout">
		<?php
		if(isset($_SESSION["uid"])){
			$sql = "SELECT * FROM user_info WHERE user_id='$_SESSION[uid]'";
			$query = mysqli_query($con,$sql);
			$row=mysqli_fetch_array($query);

			$i=1;
					$total=0;
					$allItems = '';
					$items=array();
					$total_count=$_POST['total_count'];
					while($i<=$total_count){
						$item_name_ = $_POST['item_name_'.$i];
						$amount_ = $_POST['amount_'.$i];
						$quantity_ = $_POST['quantity_'.$i];
						$total=$total+$amount_ ;
						$sql = "SELECT product_id FROM products WHERE product_title='$item_name_'";
						$query = mysqli_query($con,$sql);
						$row=mysqli_fetch_array($query);
						$product_id=$row["product_id"];
						$items[] = $item_name_ .' '.$quantity_ . ' '.$amount_;
						$i++;
					}
						$allItems =implode(", ",$items);
		
		echo'
			<div class="col-50">
				<div class="container-checkout">
				<form action="mm_pay.php" method="post">

					<div class="row-checkout">
					
					<div class="col-50">
						<h3>PAYMENT WITH MOBILE MONEY</h3>
						<label for="fname">Mobile Money Number</label>
						<input type="hidden" name="total_price" value="'.$total.'">
						<input type="hidden" name="user" value="'.$_SESSION['uid'].'">
						<input type="hidden" name="order" value="'.$allItems.'">

						<input type="text" class="form-control" id="contact" placeholder="" name="contact">



						<input type="submit" name="submit"  class="checkout-btn" value="CONFIRM" >
						
					</div>
					</div>
				</form>	
					
					<div class="col-50">

						
                    
					</div>';
					$i=1;
					$total=0;
					$allItems = '';
					$items=array();
					$total_count=$_POST['total_count'];
					while($i<=$total_count){
						$item_name_ = $_POST['item_name_'.$i];
						$amount_ = $_POST['amount_'.$i];
						$quantity_ = $_POST['quantity_'.$i];
						$total=$total+$amount_ ;
						$sql = "SELECT product_id FROM products WHERE product_title='$item_name_'";
						$query = mysqli_query($con,$sql);
						$row=mysqli_fetch_array($query);
						$product_id=$row["product_id"];
						$items[] = $item_name_ .' '.$quantity_ . ' '.$amount_;
						echo "	
						<input type='hidden' name='prod_id_$i' value='$product_id'>
						<input type='hidden' name='prod_price_$i' value='$amount_'>
						<input type='hidden' name='prod_qty_$i' value='$quantity_'>
						";
						$i++;
					}
					$allItems =implode(", ",$items);
				
				
				echo'
				<br /><br />
				<h5 class="text-center h5">OR</h5> <br /><br />	
				<form action="on_delivery.php" method="post">
					<input type="hidden" name="total_price" value="'.$total.'">
					<input type="hidden" name="delivery" value="Payment on Delivery">
					<input type="hidden" name="user_id" value="'.$_SESSION['uid'].'">
					<input type="hidden" name="order" value="'.$allItems.'">
					<input type="submit" id="submit" name="submit" value="PAYMENT ON DELIVERY" class="checkout-btn">
				</form>
				</div>
			</div>
			';
		}else{
			echo"<script>window.location.href = 'cart.php'</script>";
		}
		?>

			<div class="col-25">
				<div class="container-checkout">
				
				<?php
				if (isset($_POST["cmd"])) {
				
					$user_id = $_POST['custom'];
					
					
					$i=1;
					echo
					"
					<h4 class='h5'><b>YOUR ORDER</b>
					<span class='price' style='color:black'>
					<i class='fa fa-shopping-cart'></i> 
					(<b class'h5'>$total_count</b>)
					</span>
				</h4>

					<table class='table table-condensed'>
					<thead><tr>
					
					<th>PRODUCT</th>
					<th>QUANTITY</th>
					<th>AMOUNT</th></tr>
					</thead>
					<tbody>
					";
					
					$total=0;
					while($i<=$total_count){
						$item_name_ = $_POST['item_name_'.$i];
						
						$item_number_ = $_POST['item_number_'.$i];
						
						$amount_ = $_POST['amount_'.$i];
						
						$quantity_ = $_POST['quantity_'.$i];
						$total=$total+$amount_ ;
						$sql = "SELECT product_id FROM products WHERE product_title='$item_name_'";
						
						$query = mysqli_query($con,$sql);
						$row=mysqli_fetch_array($query);

						$product_id=$row["product_id"];
					
						echo "	

						<tr><td><p>$item_name_</p></td><td ><p>$quantity_</p></td><td ><p>$amount_</p></td></tr>";
						
						$i++;
					}
					
					
					

				echo"

				</tbody>
				</table>
				<hr>
				
				<h5 class='h5'>TOTAL<span class='price' style='color:black'><h5 class='h5'><b>Shs $total</b></h5></span></h5>";

				
				
					
				
			}
			
				?>
				</div>
			</div>
		</div>
	</div>
</section>
		
		
<?php
include "footer.php";
?>