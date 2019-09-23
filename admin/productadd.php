<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Product.php';?>

<?php 
    $product = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $createdProduct = $product->insertProduct($_POST, $_FILES);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">   
        <?php
            if(isset($createdProduct)){
                echo $createdProduct;
            }
        ?>            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Product Name</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Product Name..." name="product_name" class="medium" />
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
                                    while($data = $allCategory->fetch_assoc()){    
                            ?>
                            <option value="<?php echo $data['cat_id']; ?>"><?php echo $data['cat_name']; ?></option>
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
                                    while($data = $allBrand->fetch_assoc()){
                            ?>
                            <option value="<?php echo $data['brand_id']; ?>"><?php echo $data['brand_name']; ?></option>
                        <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Product Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="description"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Price..." class="medium" name="product_price" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Product Image</label>
                    </td>
                    <td>
                        <input type="file" name="product_image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="product_type">
                            <option>Select Type</option>
                            <option value="0">Featured</option>
                            <option value="1">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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


