<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath . "/../lib/Database.php");
	include_once ($filepath . "/../helpers/Format.php");
?>
<?php
/**
 * Brand Class
 */
class Brand
{
	private $db;
	private $fm;
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	//insert brand into database
	public function createBrand($brand_name){
		$brand_name = $this->fm->validation($brand_name);
		$brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
		if(empty($brand_name)){
			$msg = "<span class='error'>Brand name can not be empty!!!</span>";
			return $msg;
		}else{
			$query = "INSERT INTO brands(brand_name) VALUES('$brand_name')";
			$createBrand = $this->db->insert($query);
			if($createBrand){
				$msg = "<span class='success'>Brand name Inserted Successfully..</span>";
		    	return $msg;
			}else{
				$msg = "<span class='error'>Failed to insert Brand Name.</span>";
		    	return $msg;
			}
		}
	}

	//list of all Brands
	public function getAllBrand(){
		$query = "SELECT * FROM brands ORDER BY brand_id DESC";
		$brandList = $this->db->select($query);
		return $brandList;
	}

	//update category name
	public function updateBrand($brand_name, $id){
		$brand_name = $this->fm->validation($brand_name);
		$brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
		$id = mysqli_real_escape_string($this->db->link, $id);
		if(empty($brand_name)){
			$msg = "<span class='error'>Brand name can not be empty!!!</span>";
			return $msg;
		}else{
			$query = "UPDATE brands 
					  SET brand_name = '$brand_name'
					  WHERE brand_id = '$id' ";
			$updatedRow = $this->db->update($query);
			 if($updatedRow){
		    	$msg = "<span class='success'>Brand Name Updated Successfully..</span>";
		    	return $msg;
		    }else{
		    	$msg = "<span class='error'>Failed to update Brand Name.</span>";
		    	return $msg;
		    }  
		}
	}

	//get brand by brand Id
		public function getBrandById($id){
			$query = "SELECT * FROM brands WHERE brand_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		//delete brand by id
		public function deleteBrandById($id){
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "DELETE FROM brands WHERE brand_id = '$id'";
		$deleteBrand = $this->db->delete($query);
		if($deleteBrand){
		    	$msg = "<span class='success'>Brand Name Deleted Successfully..</span>";
		    	return $msg;
		    }else{
		    	$msg = "<span class='error'>Failed to delete this Brand..!!</span>";
		    	return $msg;
		    }  
		}
}

?>