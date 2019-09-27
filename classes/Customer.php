
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath . "/../lib/Database.php");
	include_once ($filepath . "/../helpers/Format.php");
?>

<?php
	class Customer{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function customerRegistration($data){

			//validating the field values
			$name = $this->fm->validation($data['name']);
			$city = $this->fm->validation($data['city']);
			$zip_code = $this->fm->validation($data['zip_code']);
			$email = $this->fm->validation($data['email']);
			$address = $this->fm->validation($data['address']);
			$country = $this->fm->validation($data['country']);
			$phone = $this->fm->validation($data['phone']);
			$password =md5($this->fm->validation($data['password']));


			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zip_code = mysqli_real_escape_string($this->db->link, $data['zip_code']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			

			//image inserting code
			if($name == "" || $city == "" || $zip_code == "" || $email == "" || $address == "" || $country == ""  || $phone == "" || $password == ""){
				$msg = "<span class='error'>Fields can not be empty</span>";
				return $msg;
			}else{

				$query = "INSERT INTO customers(name, city, zip_code, email, address, country, phone, password) VALUES('$name', '$city', '$zip_code', '$email', '$address', '$country', '$phone', '$password')";
				$customerInsert = $this->db->insert($query);

				//showing success or error message
				if($customerInsert){
		    	$msg = "<span class='success hide-it'>You have registered successfully.</span>";
		    	return $msg;
		    	}else{
		    	$msg = "<span class='error'>Registration Failed!!!</span>";
		    	return $msg;
		   		}  
			}
		}
	}
?>