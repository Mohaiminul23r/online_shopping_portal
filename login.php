<?php include 'inc/header.php'; ?>

<?php
	$customer = new Customer();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
    $cusReg = $customer->customerRegistration($_POST);
    }
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="hello" method="get" id="member">
                	<input name="Domain" type="text" value="Username" class="field" >
                    <input name="Domain" type="password" value="Password" class="field">
                 </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><button class="grey">Sign In</button></div></div>
                    </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<form action="" method="post">
    			    <?php
				    	if(isset($cusReg)){
				    		echo $cusReg;
				    	}
		    		?>
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="enter your full name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="city">
							</div>
							
							<div>
								<input type="text" name="zip_code" placeholder="zip code" >
							</div>
							<div>
								<input type="text" name="email" placeholder="example@gmail.com">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="address">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
				 </div>		        
		           <div>
		          <input type="text" name="phone" placeholder="enter phone number">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="enter password" >
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>