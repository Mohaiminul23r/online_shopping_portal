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
			$product_name = $result['product_name'];
			$product_price = $result['product_price'];
			$product_image = $result['product_image'];
			$checkquery = "SELECT * FROM carts WHERE session_id = '$session_id' AND product_id = '$product_id'";
			$incheck = $this->db->select($checkquery);
			//checking the duplicate insert
			if($incheck){
				$msg = "<span class='error'>Product already taken</span>";
		  		return $msg;
			}else{
				$insertquery = "INSERT INTO carts(session_id, product_id, product_name, price, quantity, product_image) VALUES('$session_id', '$product_id', '$product_name','$product_price', '$quantity', '$product_image' )";
				$ires = $this->db->insert($insertquery);
		
				if($ires){
		    		header("Location: cartpage.php");
		    	}else{
		    		header("Location: 404.php");
		   		}  
			}
		}//end of method

		public function getAllCat(){
			$query = "SELECT * FROM carts ORDER BY session_id ";
			$result = $this->db->select($query);
			return $result;
		}//end method

		public function updateQuantity($quantity, $cart_id){
			$query = "UPDATE carts
					  SET quantity = '$quantity' 
					  WHERE cart_id = '$cart_id'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Cart has been updated successfully.</span>";
		  		return $msg;
			}else{
				$msg = "<span class='error'>Failed to update cart.</span>";
		  		return $msg;
			}
		}//end method

		public function deleteProductFromCart($c_id){
			$query = "DELETE FROM carts WHERE cart_id = '$c_id'";
			$result = $this->db->delete($query);
			if($result){
				echo "<script>window.location = 'cartpage.php';</script>";
			}else{
				$msg = "<span class='error'>Unable to delete product from cart.</span>";
		  		return $msg;
			}
		}//end method

		public function getTotalSum(){
			$session_id = session_id();
			$query = "SELECT * FROM carts WHERE session_id = '$session_id'";
			$result = $this->db->select($query);
			return $result;
		}
	}//end of the class
?>