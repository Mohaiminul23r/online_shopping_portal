<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath . "/../lib/Database.php");
	include_once ($filepath . "/../helpers/Format.php");
?>

<?php
	class Product{
		private $db;
	    private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insertProduct($data, $file){

			//validating the field values
			$product_name = $this->fm->validation($data['product_name']);
			// $cat_id = $this->fm->validation($data['cat_id']);
			// $brand_id = $this->fm->validation($data['brand_id']);
			// $description = $this->fm->validation($data['description']);
			// $product_price = $this->fm->validation($data['product_price']);
			// $product_type = $this->fm->validation($data['product_type']);
		
			$product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
			$cat_id = mysqli_real_escape_string($this->db->link, $data['cat_id']);
			$brand_id = mysqli_real_escape_string($this->db->link, $data['brand_id']);
			$description = mysqli_real_escape_string($this->db->link, $data['description']);
			$product_price = mysqli_real_escape_string($this->db->link, $data['product_price']);
			$product_type = mysqli_real_escape_string($this->db->link, $data['product_type']);

			//image inserting code
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['product_image']['name'];
			$file_size = $file['product_image']['size'];
			$file_temp = $file['product_image']['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/". $unique_image;
			if($product_name == "" || $cat_id == "" || $brand_id == "" || $description == "" || $product_price == "" || $product_type == ""){
				$msg = "<span class='error'>Fields can not be empty</span>";
				return $msg;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO products2(product_name, cat_id, brand_id, description, product_price, product_image, product_type) VALUES('$product_name', '$cat_id', '$brand_id', '$description', '$product_price', '$uploaded_image', '$product_type' )";
				$insertProduct = $this->db->insert($query);

				//showing success or error message
				if($insertProduct){
		    	$msg = "<span class='success hide-it'>Products has been created successfully..</span>";
		    	return $msg;
		    	}else{
		    	$msg = "<span class='error'>Failed to create product</span>";
		    	return $msg;
		   		}  
			}
		}

		//get or select all products
		public function getAllProducts(){
			//joining tables using aliases
				$query = "SELECT p.*, b.brand_name, c.cat_name
					  FROM products2 as p, brands as b, categories as c
					  WHERE p.brand_id = b.brand_id AND p.cat_id = c.cat_id
					  ORDER BY p.product_id DESC";

			//joining three tables using inner join
			/*
			$query = "SELECT products2.*, brands.brand_name, categories.cat_name
					  FROM products2
					  INNER JOIN brands
					  ON products2.brand_id = brands.brand_id
					  INNER JOIN categories
					  ON products2.cat_id = categories.cat_id
					  ORDER BY products2.product_id DESC";
		    */
			$result = $this->db->select($query);
			return $result;
		}

		//get all products to show for editing
		public function getAllProductById($id){
			$query = "SELECT * FROM products2 WHERE product_id = '$id'";
			$getProduct = $this->db->select($query);
			return $getProduct;
		}

		//update products
		public function updateProduct($products, $file, $id){
			//validating the field values
			$product_name = mysqli_real_escape_string($this->db->link, $products['product_name']);
			$cat_id = mysqli_real_escape_string($this->db->link, $products['cat_id']);
			$brand_id = mysqli_real_escape_string($this->db->link, $products['brand_id']);
			$description = mysqli_real_escape_string($this->db->link, $products['description']);
			$product_price = mysqli_real_escape_string($this->db->link, $products['product_price']);
			$product_type = mysqli_real_escape_string($this->db->link, $products['product_type']);

			//image updating code 
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['product_image']['name'];
			$file_size = $file['product_image']['size'];
			$file_temp = $file['product_image']['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/". $unique_image;
			if($product_name == "" || $cat_id == "" || $brand_id == "" || $description == "" || $product_price == "" || $product_type == ""){
				$msg = "<span class='error'>Fields can not be empty</span>";
				return $msg;
			}else{

				if(!empty($file_name)){
					if($file_size > 1048567){
					echo "<span class='error'>Image size can not be less than 1 MB !!</span>";
				}elseif(in_array($file_ext, $permited) === false){
					echo "<span class='error'>You can upload only:-".implode(',' , $permited)."</span>";
				}else {
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE products2
					  SET 
					   product_name    = '$product_name',
					   cat_id          = '$cat_id',
					   brand_id        = '$brand_id',
					   description     = '$description',
					   product_price   = '$product_price',
					   product_image   = '$uploaded_image',
					   product_type    = '$product_type'
					   WHERE product_id = '$id'; ";
						$updateProductRow = $this->db->update($query);
			
						//showing success or error message
						if($updateProductRow){
				    	$msg = "<span class='success'>Products has been updated successfully..</span>";
				    	return $msg;
				    	}else{
				    	$msg = "<span class='error'>Failed to Update Product!!!</span>";
				    	return $msg;
				   		} 
				}
				}else{
					$query = "UPDATE products2
					  SET 
					   product_name    = '$product_name',
					   cat_id          = '$cat_id',
					   brand_id        = '$brand_id',
					   description     = '$description',
					   product_price   = '$product_price',
					   product_type    = '$product_type'
					   WHERE product_id = '$id'; ";
						$updateProductRow = $this->db->update($query);
			
						//showing success or error message
						if($updateProductRow){
				    	$msg = "<span class='success'>Products has been updated successfully..</span>";
				    	return $msg;
				    	}else{
				    	$msg = "<span class='error'>Failed to Update Product!!!</span>";
				    	return $msg;
				   		} 
				}										 
			}
		 
		}//end of updateProduct method

		public function deleteProductById($id){

			$id = mysqli_real_escape_string($this->db->link, $id);

			//delete or remove image from the upload folder
			$query = "SELECT * FROM products2 WHERE product_id = '$id'";
			$getData = $this->db->select($query );
			if($getData){
				while($db_image = $getData->fetch_assoc()){
					$delete_image = $db_image['product_image'];
					unlink($delete_image);
				}
			}
			//delete query for deleting product row
			$delquery = "DELETE FROM products2 WHERE product_id = '$id'";
			$deleteProductRow = $this->db->delete($delquery);

			//showing success or error message
				if($deleteProductRow){
				   $msg = "<span class='success'>Products has been deleted successfully..</span>";
				   return $msg;
				}else{
				   $msg = "<span class='error'>Failed to Delete Product!!!</span>";
				   return $msg;
				} 
		}//end of method

		public function getFeatureProduct(){
			$query = "SELECT * FROM products2 WHERE product_type = '0' ORDER BY product_id DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}//end of method

		public function getGeleralProduct(){
			$query = "SELECT * FROM products2 WHERE product_type = '1' ORDER BY product_id DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}//end of method
	}//end of Product class
?>