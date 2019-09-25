<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
	
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      		   $getFeaturepd = $pd->getFeatureProduct();
	      		   if($getFeaturepd){
	      		   while($result = $getFeaturepd->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['product_id']; ?> "><img height="150px" width="180px" src="admin/<?php echo $result['product_image']?>" alt="" /></a>
					 <h2><?php echo $result['product_name']; ?></h2>
					 <p><?php echo $fm->textShorten($result['description'], 60); ?></p>
					 <p><span class="price"><?php echo $result['product_price']." tk"; ?></span></p>
				     <div class="button"><span><a href="preview.php?proid=<?php echo $result['product_id']; ?>" class="details">Details</a></span></div>
				</div>	
				<?php } } ?>		
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>General Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$getGeneralpd = $pd->getGeleralProduct();
					if($getGeneralpd){
						while($data = $getGeneralpd->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $data['product_id']; ?>"><img height="150px" width="180px" src="admin/<?php echo $data['product_image']?>" alt="" /></a>
					 <h2><?php echo $data['product_name']; ?></h2>
					 <p><span class="price"><?php echo $data['product_price']." tk"; ?></span></p>
				     <div class="button"><span><a href="preview.php?proid=<?php echo $data['product_id']; ?>" class="details">Details</a></span></div>
				</div>
			<?php } } ?>	
			</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>