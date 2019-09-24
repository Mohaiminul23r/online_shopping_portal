<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php include_once '../helpers/Format.php'; ?>

<?php
	$fm = new Format();
	$product = new Product();

	//getting product id and send id to method
	if(isset($_GET['delete_product_id'])){
		$id = $_GET['delete_product_id'];
		$deleteProduct = $product->deleteProductById($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Products List</h2>
        <div class="block">  
        	<?php
        		if(isset($deleteProduct)){
        			echo $deleteProduct;
        		}
        	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Product Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$product = new Product();
				$allProducts = $product->getAllProducts();
				if($allProducts){
					$i = 0;
					while($data = $allProducts->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $data['product_name']; ?></td>
					<td><?php echo $data['cat_name']; ?></td>
					<td><?php echo $data['brand_name']; ?></td>
					<td style="width: 30%;"><?php echo $fm->textShorten($data['description']); ?></td>
					<td><?php echo $data['product_price']." tk"; ?></td>
					<td><img src="<?php echo $data['product_image']; ?>" height="60px" width="80px"/></td>
					<td>
						<?php 
								if($data['product_type']== 0){
									echo "Featured";
								}else{
									echo "General";
								}
						?> 
					</td>
					
					<td><a href="product_edit.php?product_id=<?php echo $data['product_id']?>">Edit</a> || <a onclick= "return confirm('Do you want to delete this product?')" href="?delete_product_id=<?php echo $data['product_id']?>">Delete</a></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
