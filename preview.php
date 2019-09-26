<?php include 'inc/header.php'; ?>
<?php
	//getting id of brand
	if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
		echo "<script>window.location = '404.php';</script>";
	}else{
		$pid = $_GET['proid'];
	//	$id = preg_replace('[/^-a-zA-Z0-9_/]', '', $_GET['proid']);
	}

	//getting quantity and send to the class method
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $quantity = $_POST['quantity'];
        $pd_quantity = $ct->addToCart($quantity, $pid);
	 }
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
			    <?php
					$getProductDetails = $pd->showProductDetails($pid);
					if($getProductDetails){
						while($productDetails = $getProductDetails->fetch_assoc()){
				?>			
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $productDetails['product_image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $productDetails['product_name']; ?></h2>
					<p><?php echo  $fm->textShorten($productDetails['description']); ?></p>					
					<div class="price">
						<p>Price: <span><?php echo  $productDetails['product_price']; ?></span></p>
						<p>Category: <span><?php echo  $productDetails['cat_name']; ?></span></p>
						<p>Brand:<span><?php echo  $productDetails['brand_name']; ?></span></p>
					</div>

				<div class="add-cart">
				<span style="color: red; font-size: 16px;">
					<?php
						if(isset($pd_quantity)){
							echo $pd_quantity;
						}
					?>	
				</span>
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit"  value="Add to Cart"/>
					</form>
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo  $productDetails['description']; ?></p>      
	    </div>
		<?php  } } ?>	
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>			
					<ul>
				      <li><a href="productbycat.php">Mobile Phones</a></li>
				      <li><a href="productbycat.php">Desktop</a></li>
				      <li><a href="productbycat.php">Laptop</a></li>
				      <li><a href="productbycat.php">Accessories</a></li>
				      <li><a href="productbycat.php">Software</a></li>
					   <li><a href="productbycat.php">Sports & Fitness</a></li>
					   <li><a href="productbycat.php">Footwear</a></li>
					   <li><a href="productbycat.php">Jewellery</a></li>
					   <li><a href="productbycat.php">Clothing</a></li>
					   <li><a href="productbycat.php">Home Decor & Kitchen</a></li>
					   <li><a href="productbycat.php">Beauty & Healthcare</a></li>
					   <li><a href="productbycat.php">Toys, Kids & Babies</a></li>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
<?php include 'inc/footer.php'; ?>