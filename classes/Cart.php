<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath . "/../lib/Database.php");
	include_once ($filepath . "/../helpers/Format.php");
?>

<?php
	class Cart{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function addToCart($quantity, $pid){

			//validation of the field
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$product_id = mysqli_real_escape_string($this->db->link, $pid);
			$session_id = session_id();
			$select_query = "SELECT * FROM products2 WHERE product_id = '$product_id'";
			$result = $this->db->select($select_query)->fetch_assoc();
			// echo "<pre>";
			// print_r($result);
			// echo "</pre>";
			$product_name = $result['product_name'];
			$product_price = $result['product_price'];
			$product_image = $result['product_image'];

			$insertquery = "INSERT INTO carts(session_id, product_id, product_name, price, quantity, product_image) VALUES('$session_id', '$product_id', '$product_name','$product_price', '$quantity', '$product_image' )";
			$ires = $this->db->insert($insertquery);
		
			if($ires){
		    	header("Location: cart.php");
		    	}else{
		    	header("Location: 404.php");
		   		}  
		}
	}//end of the class
?>