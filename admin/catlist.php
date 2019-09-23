<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
	$cat = new Category();

	//getting category id
	if(isset($_GET['delete_cat'])){
		$id = $_GET['delete_cat'];
		$deleteCat = $cat->deleteCategoryById($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
                	<?php
                		if(isset($deleteCat)){
                			echo $deleteCat;
                		}

                	?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getCategory = $cat->getAllCategory();
							if($getCategory){
								$i = 0;
								while($result = $getCategory->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['cat_name'];?></td>
							<td><a href="category_edit.php?cat_id=<?php echo $result['cat_id'];?>">Edit</a> || <a onclick= "return confirm('Do you want to delete?')" href="?delete_cat=<?php echo $result['cat_id']; ?>">Delete</a></td>
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

