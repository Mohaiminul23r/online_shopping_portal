
<?php
	include_once '../lib/Database.php';
	include_once '../helpers/Format.php';
?>

<?php
/**
 * Category class
 */
class Category
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

//creating new category
	public function createCategory($cat_name){

		//validating field value
		$cat_name = $this->fm->validation($cat_name);
		$cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
		if(empty($cat_name)){
			$msg = "<span class='error'>Category field can not be empty!!!</span>";
			return $msg;
		}else{
		    $query = "INSERT INTO categories(cat_name) VALUES('$cat_name')";
		    $insertCategory = $this->db->insert($query);
		    if($insertCategory){
		    	$msg = "<span class='success'>Category Inserted Successfully..</span>";
		    	return $msg;
		    }else{
		    	$msg = "<span class='error'>Failed to insert Category.</span>";
		    	return $msg;
		    }
		    
		}
	}

	//get all category list
		public function getAllCategory(){
			$query = "SELECT * FROM categories ORDER BY cat_id DESC";
			$result = $this->db->select($query);
			return $result;
		}

	//get category by category Id
		public function getCategoryById($id){
			$query = "SELECT * FROM categories WHERE cat_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

	//update category name
	public function updateCategory($cat_name, $id){
		$cat_name = $this->fm->validation($cat_name);
		$cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
		$id = mysqli_real_escape_string($this->db->link, $id);
		if(empty($cat_name)){
			$msg = "<span class='error'>Category field can not be empty!!!</span>";
			return $msg;
		}else{
			$query = "UPDATE categories 
					  SET cat_name = '$cat_name'
					  WHERE cat_id = '$id' ";
			$updatedRow = $this->db->update($query);

			 if($updatedRow){
		    	$msg = "<span class='success'>Category Updated Successfully..</span>";
		    	return $msg;
		    }else{
		    	$msg = "<span class='error'>Failed to update Category.</span>";
		    	return $msg;
		    }  
		}
	}

	//delete category by id
	public function deleteCategoryById($id){
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "DELETE FROM categories WHERE cat_id = '$id'";
		$deleteCat = $this->db->delete($query);
		if($deleteCat){
		    	$msg = "<span class='success'>Category Deleted Successfully..</span>";
		    	return $msg;
		    }else{
		    	$msg = "<span class='error'>Failed to delete Category.</span>";
		    	return $msg;
		    }  
	}
}
?>