<?php
	include_once '../lib/Database.php';
	include_once '../helpers/Format.php';
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
	}
?>