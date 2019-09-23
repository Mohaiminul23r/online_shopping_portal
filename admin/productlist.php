<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php include_once '../helpers/Format.php'; ?>

<?php
		$fm = new Format();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Products List</h2>
        <div class="block">  
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
					<td><?php echo $fm->textShorten($data['description']); ?></td>
					<td><?php echo $data['product_price']." tk"; ?></td>
					<td><img src="<?php echo $data['product_image']; ?>" height="40px" width="45px"/></td>
					<td>
						<?php 
								if($data['product_type']== 0){
									echo "Featured";
								}else{
									echo "General";
								}
						?> 
					</td>
					<!-- <td class="center"> 4</td> -->
					<td><a href="">Edit</a> || <a href="">Delete</a></td>
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
