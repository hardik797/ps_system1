<!--here include the header -->
<?php
include('../includes/session.php');
	if (isset($_SESSION['message']))
	{		
		$message = '<strong>' . $_SESSION['message'] . '</strong>';
		unset($_SESSION['message']);
	}
	if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
	{
		//print_r($_SESSION['errors']);
		$error_msg = array();
		foreach ($_SESSION['errors'] as $key => $value)
		{
		    $error_msg[$key] = $value;
		}	
		//echo"<b>".$_SESSION['errors'][2]."</b>";
		//$error_message = '<strong>' . implode(', ', $_SESSION['errors']) . '</strong>';
		unset($_SESSION['errors']);	
	}
	if (isset($message))
	{
		echo $message;
	}
	if (isset($error_message))
	{
		echo $error_message;	
	}
	$post_data = array();
	if(isset($_SESSION['data']))
	{
		$post_data = $_SESSION['data'];
		unset($_SESSION['data']);
	}
	include("../includes/header.php");

?>
<script type="text/javascript">


</script>
<script type="text/javascript" src="../bootstrap-3.3.6/user_registration_validation.js"></script>
<!--Now the start of html code for user registration form -->
<div class="container-fluid">
	<div class="container bg1">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			<div class="registration-form">
				<h2 class="text-center">Registration form</h2>
				<form name="myform" class="form-horizontal"
				 action="../controller/control_user_registration.php" method="post" role="form"
				 onsubmit="return validateForm()">
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['first_name'])){echo $error_msg['first_name'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Firstname</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Firstname" value="<?php if(isset($post_data['first_name']))
										{echo $post_data['first_name'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['last_name'])){echo $error_msg['last_name'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Lastname</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Lastname" value="<?php if(isset($post_data['last_name']))
										{echo $post_data['last_name'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['email'])){echo $error_msg['email'];}
							if(isset($error_msg['email_duplicate'])){echo $error_msg['email_duplicate'];}
							?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="email" name="email" 
								placeholder="Email" value="<?php if(isset($post_data['email']))
										{echo $post_data['email'];}?>" >
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php 
							if(isset($error_msg['user_name'])){echo $error_msg['user_name'];}
							if(isset($error_msg['user_name_duplicate'])){echo $error_msg['user_name_duplicate'];}
							?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Username</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="user_name" name="user_name" 
								placeholder="Username" value="<?php if(isset($post_data['user_name']))
										{echo $post_data['user_name'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['password'])){echo $error_msg['password'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="password" name="password" 
								placeholder="Password">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['confirm_password'])){echo $error_msg['confirm_password'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Confirm passwrd</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="confirm_password" 
								name="confirm_password" placeholder="Confirm_password" >
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['country'])){echo $error_msg['country'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Country</label>
							<div class="col-sm-9">
								<select class="form-control" id="country" name="country">
									<option value="">Select-country</option>
									<?php 
										echo '<option ' . ((isset($post_data['country']) && $post_data['country'] == 'India') ? 'selected="selected"': '') . ' value="India">India</option>';
										echo '<option ' . ((isset($post_data['country']) && $post_data['country'] == 'China') ? 'selected="selected"': '') . ' value="China">China</option>';
										echo '<option ' . ((isset($post_data['country']) && $post_data['country'] == 'Bangadesh') ? 'selected="selected"': '') . ' value="Bangadesh">Bangadesh</option>';
									?>
								</select>
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['state'])){echo $error_msg['state'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">State</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="state" name="state" 
								placeholder="State" value="<?php if(isset($post_data['state']))
										{echo $post_data['state'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['city'])){echo $error_msg['city'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">City</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="city" name="city" 
								placeholder="City" value="<?php if(isset($post_data['city']))
										{echo $post_data['city'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['address_line1'])){echo $error_msg['address_line1'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Address line-1</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="address_line1" 
								name="address_line1" placeholder="Address_line1"  value="<?php if(isset($post_data['address_line1'])){echo $post_data['address_line1'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['address_line2'])){echo $error_msg['address_line2'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Address line-2</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="address_line2" 
								name="address_line2" placeholder="Address_line2" value="<?php if(isset($post_data['address_line2'])){echo $post_data['address_line2'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['zipcode'])){echo $error_msg['zipcode'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Zipcode</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="zipcode" name="zipcode" 
								placeholder="Zipcode" value="<?php if(isset($post_data['zipcode'])){echo $post_data['zipcode'];}?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3"></label>
							<div class="col-sm-9">
								<input type="submit" class="btn btn-primary" id="submit" name="submit" 
								value="Submit">
								<input type="button" class="btn btn-primary" id="reset" name="reset" 
								value="Reset">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-8">
								<a class="" href="login.php">
									<span class="glyphicon glyphicon-hand-right">&nbsp;</span>Signin
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--here include the footer -->
<?php
include("../includes/footer.php")
?>