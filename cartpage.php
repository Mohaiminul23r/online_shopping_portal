<?php include 'inc/header.php'; ?>

<?php
	//update the cart amount
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$cart_id = $_POST['cart_id'];
		$quantity = $_POST['quantity'];
		$updateQuantity = $ct->updateQuantity($quantity, $cart_id);
		if($quantity <= 0){
			$deleteCart = $ct->deleteProductFromCart($cart_id);
		}
	}

	//delete product from the cart
	if(isset($_GET['cartid'])){
		$c_id = $_GET['cartid'];
		//$c_id = preg_replace('/[^-a-zA-Z0-9]/','', $_GET['cartid']);
		$deleteCart = $ct->deleteProductFromCart($c_id);
	}

?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="text-align: center; width: 300px;">Customer Cart</h2>
			    	<span style="color: green; font-size: 18px; font-style: italic; text-align: middle;">
					<?php
						if(isset($updateQuantity)){
							echo $updateQuantity;
						}
						if(isset($deleteCart)){
							echo $deleteCart;
						}
					?>	
					</span>
						<table class="tblone">
							<tr>
								<th width="10%">SL</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$getCart = $ct->getAllCat();
								if($getCart){
									$i = 0;
									$sum = 0;
									$quantity = 0;
									while($data = $getCart->fetch_assoc()){
										$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $data['product_name']; ?></td>
								<td><img src="admin/<?php echo $data['product_image']; ?>" alt=""/></td>
								<td><?php echo $data['price']." tk"; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cart_id" value="<?php echo $data['cart_id']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $data['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									<?php 
										$total =  $data['price'] * $data['quantity'];
										echo $total." tk"; 
									?>	
								</td>
								<!-- <td><a onclick= "return confirm('Do you want to delete this product from the cart?')" href="?cartid = <?php echo $data['cart_id']?>">Delete</a></td> -->
								<td>
									<a onclick= "return confirm('Do you want to delete this product from the cart?')" href="?cartid=<?php echo $data['cart_id']?>">
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>

							<?php
								$quantity+= $data['quantity'];
								$sum = $sum + $total;
								Session::set("sum", $sum);
								Session::set("quantity", $quantity);
							?>
							<?php } }?>							
						</table>
						<?php
							$getData = $ct->getTotalSum();
							if($getData){
						?>
						<table style="float:right;text-align:right; font-style: italic" width="40%">
							<tr>
								<th><i><b>Sub Total :</b></i></th>
								<td>
									<?php 
										//$sum = 0;
										echo $sum . " tk";
								 	?>	
								</td>
							</tr>
							<tr>
								<th><i><b>Aditional 10% Vat:</b></i></th>
								<td style="text-align:right; font-style: italic">
									<?php
										$targetedVat = 0.1;
										$vat =  $sum * $targetedVat;
										echo $vat . " tk";
									?>	
								</td>
							</tr>
							<tr>
								<th><i><b>Grand Total :</b></i></th>
								<td style="text-align:right; font-style: italic">
									<?php
										$grandTotal = $sum + $vat;
										echo $grandTotal . " tk"; 
									?>
								</td>
							</tr>
					   </table>
					<?php }else{
						echo "You have nothing in the Cart. Shop Now";
					}?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>