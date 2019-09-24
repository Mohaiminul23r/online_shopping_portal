<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Product.php';?>

<?php
	//getting product id for editing individual product
	if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL){
		//echo "<script>window.location = 'productlist.php'; </script>";
	}else{
		$product2 = new Product();
		$id = $_GET['product_id'];
		$getAllProducts = $product2->getAllProductById($id);
	}
?>

<?php 
	//sending field data and files to the update method of Product class
    $product = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $updateProduct = $product->updateProduct($_POST, $_FILES, $id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">   
        <?php
            if(isset($updateProduct)){
                echo $updateProduct;
            }
        ?>            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
            	<?php
            		//$getAllProducts = $product->getAllProductById($id);
            		if($getAllProducts){
            			while($values = $getAllProducts->fetch_assoc()){
            	?>
                <tr>
                    <td>
                        <label>Product Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $values['product_name']; ?>" name="product_name" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Product Category</label>
                    </td>
                    <td>
                        <select id="select" name="cat_id">
                            <option>Select Category</option>
                            <?php
                                $cat = new Category();
                                $allCategory = $cat->getAllCategory();
                                if($allCategory){
                                    while($categories = $allCategory->fetch_assoc()){    
                            ?>
                            <option
                            <?php 
                            		if($values['cat_id'] == $categories['cat_id']) { ?>
                            			selected = "selected"
                            	<?php } ?> value="<?php echo $values['cat_id']; ?>">
                            	
                            	<?php echo $categories['cat_name']; ?>	
                            </option>

                            <?php } }?>  

                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Product Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand_id">
                            <option>Select Brand</option>
                            <?php
                                $brand = new Brand();
                                $allBrand = $brand->getAllBrand();
                                if($allBrand){
                                    while($brands = $allBrand->fetch_assoc()){
                            ?>
                            <option 
                            	<?php 
                            		if($values['brand_id'] == $brands['brand_id']) { ?>
                            			selected = "selected"
                            	<?php } ?> value="<?php echo $values['brand_id']; ?>">
                            	
                            	<?php echo $brands['brand_name']; ?>
                            		
                            </option>
                        <?php } } ?>
                        </select>
                    </td>
                </tr>
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Product Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="description">
                        	<?php echo $values['description']; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $values['product_price']; ?>" class="medium" name="product_price" />
                    </td>
                </tr>            
                <tr>
                    <td>
                        <label>Product Image</label>
                    </td>
                    <td>
                    	<img src="<?php echo $values['product_image']; ?>" height="150px" width="180px"/></br>
                        <input type="file"  name="product_image"/>
                    </td>
                </tr>				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="product_type">
                            <option>Select Type</option>
                            <?php 
                            	if($values['product_type'] == 0) { ?>
                            		<option value="0" selected = "selected" >Featured</option>
                                    <option value="1">General</option>
                            <?php	}else { ?> 
                            <option value="0">Featured</option>
                            <option value="1" selected = "selected">General</option>
                        	<?php } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                        <a  href="admin/productlist.php"><button>Go Back</button></a>
                    </td>
                </tr>
            </table>
            </form>
        <?php } } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


