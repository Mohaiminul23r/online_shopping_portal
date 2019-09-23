<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
	$brand = new Brand();

	//getting brand by id
	if(isset($_GET['delete_brand'])){
		$id = $_GET['delete_brand'];
		$deleteBrand = $brand->deleteBrandById($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 
                	<?php
                		if(isset($deleteBrand)){
                			echo $deleteBrand;
                		}

                	?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getBrand = $brand->getAllBrand();
							if($getBrand){
								$i = 0;
								while($result = $getBrand->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brand_name'];?></td>
							<td><a href="brand_edit.php?brand_id=<?php echo $result['brand_id'];?>">Edit</a> || <a onclick= "return confirm('Do you want to delete this brand?')" href="?delete_brand=<?php echo $result['brand_id']; ?>">Delete</a></td>
						</tr>
					<?php   } } ?>
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

