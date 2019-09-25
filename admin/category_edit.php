<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php

	$cat = new Category();

 	//getting id of category
	if(!isset($_GET['cat_id']) || $_GET['cat_id'] == NULL){
		// echo "<script>window.location = 'catlist.php';</script>";
	}else{
		$id = $_GET['cat_id'];
	}

	//updating category name
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cat_name = $_POST['cat_name'];
        $updateCategory = $cat->updateCategory($cat_name, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 

                    <?php
                        if(isset($updateCategory)){
                            echo $updateCategory;
                        }
                    ?>

                    <?php
                    	$getCategory = $cat->getCategoryById($id);
                    	if($getCategory){
                    		while($result = $getCategory->fetch_assoc()){
                    ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="cat_name" class="medium" value="<?php echo $result['cat_name']; ?>"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>