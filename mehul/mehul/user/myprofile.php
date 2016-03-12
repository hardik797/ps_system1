<!--include header -->
<?php
include("../includes/session.php");
include("../includes/header.php");
if(isset($_SESSION['user']))
{
$result1 = get_rows("select id, first_name, last_name, email, user_name, password, country, state, city, address_line1, address_line2, zipcode from  user_registration where user_name = ?",
	 array($_SESSION['user']));
	$array_user_data = array();
				foreach ($result1 as $row) 
				{
					$array_user_data = $row ;
				}
				if (isset($_SESSION['message']))
				{		
					echo $message = '<strong>' . $_SESSION['message'] . '</strong>';
					unset($_SESSION['message']);
				}
				if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
				{
					$error_msg = array();
					foreach ($_SESSION['errors'] as $key => $value)
					{
					    $error_msg[$key] = $value;
					}	
					unset($_SESSION['errors']);	
				}
?>

<style type="text/css">
	span
	{
		padding-bottom:5px; 
	}
</style>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Myprofile</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Page</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>
					<?php  echo "Wellcome ".ucfirst($_SESSION['user']); ?></a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid content">
		<h2 class="text-center">Wel come </h2>
			<div class="row">
				<div class="col-md-3">
				<img class="img-responsive" src="../img/user.jpg" alt="user">
					<form class="form-horizontal" method="post" action="../controller/control_user_photo.php" enctype="multipart/form-data">
						
						<input type="file" name="file"/>
						<input type="submit" class="btn btn-small" value="upload" />
					</form>
				</div>
				<div class="col-md-9">
					<div class="col-md-6 col-md-offset-3">
			<div class="">
				<h2 class="text-center">Profile details</h2>
				<form name="myform" class="form-horizontal"
				 action="../controller/control_user_update_data.php" method="post" role="form"
				 onsubmit="return validateForm()">
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['first_name'])){echo $error_msg['first_name'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Firstname</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Firstname" value="<?php if(isset($array_user_data['first_name']))
										{echo $array_user_data['first_name'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['last_name'])){echo $error_msg['last_name'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Lastname</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Lastname" value="<?php if(isset($array_user_data['last_name']))
										{echo $array_user_data['last_name'];}?>">
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
								placeholder="Email" value="<?php if(isset($array_user_data['email']))
										{echo $array_user_data['email'];}?>" readonly >
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
								placeholder="Username" value="<?php if(isset($array_user_data['user_name']))
										{echo $array_user_data['user_name'];}?>" disabled >
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['password'])){echo $error_msg['password'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="password" name="password" 
								placeholder="Password" value="<?php if(isset($array_user_data['password']))
										{echo $array_user_data['password'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['confirm_password'])){echo $error_msg['confirm_password'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Confirm passwrd</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="confirm_password" 
								name="confirm_password" placeholder="Confirm_password" value="<?php if(isset($array_user_data['password']))
										{echo $array_user_data['password'];}?>">
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
										echo '<option ' . ((isset($array_user_data['country']) && 
											$array_user_data['country'] == 'India') ? 'selected="selected"': '') . ' value="India">India</option>';
										echo '<option ' . ((isset($array_user_data['country']) && $array_user_data['country'] == 'China') ? 'selected="selected"': '') . ' value="China">China</option>';
										echo '<option ' . ((isset($array_user_data['country']) && $array_user_data['country'] == 'Bangadesh') ? 'selected="selected"': '') . ' value="Bangadesh">Bangadesh</option>';
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
								placeholder="State" value="<?php if(isset($array_user_data['state']))
										{echo $array_user_data['state'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['city'])){echo $error_msg['city'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">City</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="city" name="city" 
								placeholder="City" value="<?php if(isset($array_user_data['city']))
										{echo $array_user_data['city'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['address_line1'])){echo $error_msg['address_line1'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Address line-1</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="address_line1" 
								name="address_line1" placeholder="Address_line1"  value="<?php if(isset(
								$array_user_data['address_line1'])){echo $array_user_data['address_line1'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['address_line2'])){echo $error_msg['address_line2'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Address line-2</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="address_line2" 
								name="address_line2" placeholder="Address_line2" value="<?php if(isset(
								$array_user_data['address_line2'])){echo $array_user_data['address_line2'];}?>">
							</div>
						</div>
						<span class="col-sm-9 col-sm-offset-3 text-danger">
							<?php if(isset($error_msg['zipcode'])){echo $error_msg['zipcode'];}?>
						</span>
						<div class="form-group">
							<label class="control-label col-sm-3">Zipcode</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="zipcode" name="zipcode" 
								placeholder="Zipcode" value="<?php if(isset($array_user_data['zipcode'])){echo $array_user_data['zipcode'];}?>">
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
					</form>
				</div>
				</div>
				</div>
				<!--end th div col-md-9 -->
			</div>	
	</div>
	<div class="container-fluid text-center footer">
		<p>All &copy;&nbsp;copyright reserved</p>
	</div>

<!--here include the footer -->
<?php
include("../includes/footer.php");
}
else
{
	$_SESSION['errors'][] = "Please login first";
	header("location: login.php");
}

?>