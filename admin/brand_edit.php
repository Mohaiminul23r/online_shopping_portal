<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>

<?php

	$brand = new Brand();

 	//getting id of brand
	if(!isset($_GET['brand_id']) || $_GET['brand_id'] == NULL){
		echo "<script>window.location = 'brand_list.php';</script>";
	}else{
		$id = $_GET['brand_id'];
	}

	//updating brand name
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brand_name = $_POST['brand_name'];
        $updateBrand = $brand->updateBrand($brand_name, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand Name</h2>
               <div class="block copyblock"> 

                    <?php
                        if(isset($updateBrand)){
                            echo $updateBrand;
                        }
                    ?>

                    <?php
                    	$getBrand = $brand->getBrandById($id);
                    	if($getBrand){
                    		while($result = $getBrand->fetch_assoc()){
                    ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brand_name" class="medium" value="<?php echo $result['brand_name']; ?>"/>
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