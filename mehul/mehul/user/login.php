<!--include header -->
<?php
include("../includes/session.php");
include("../includes/header.php");
if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
{
	$error_message = implode(",", $_SESSION['errors']);
	unset($_SESSION['errors']); 	
}
$post_data = array();
if(isset($_SESSION['data']))
{
	$post_data = $_SESSION['data'];
	unset($_SESSION['data']);
}
?>
<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<h2 class="text-center text-success">
					Sign in to continue 
				<span class="text-info">Myprofile</span>
				</h2>
				<div class="login-form">
					<h2 class="text-center">Login</h2>
					<form class="form-horizontal" action="../controller/control_user_login.php" method="post">
						<!--<div class="col-sm-12">
							<img class="img-responsive img-circle center-block" src="../img/user.jpg" alt="user"
							height="100" width="100">
						</div>-->
						<div class="col-sm-9 col-sm-offset-3">
							<?php 
							if(isset($error_message))
							{
								echo "<small class='text-center text-danger'>".$error_message."</small>";
							}
						?>
						</div>
						<div class="form-group">
							<label class="label-control col-sm-3">Username</label>
							<div class="col-sm-9">
									<input type="text" class="form-control" id="user_name" name="user_name" 
									placeholder="Username & Email"
									 value='<?php if(isset($post_data['user_name']))
									 {echo $post_data['user_name'];}?>' >
							</div>
						</div>
						<div class="form-group">
							<label class="label-control col-sm-3">Password</label>
							<div class="col-sm-9">
									<input type="password" class="form-control" id="password" name="password" 
									placeholder="Password" >
							</div>
						</div>
						<div class="form-group">
							<label class="label-control col-sm-3"></label>
							<div class="col-sm-9">
									<input type="checkbox" > Remember me
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3"></label>
							<div class="col-sm-9">
								<input type="submit" class="btn btn-primary" id="submit" name="submit" 
								value="Submit" >
								<input type="button" class="btn btn-primary" id="reset" name="reset" 
								value="Reset">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-8">
								<a class="" href="user_registration.php">
									<span class="glyphicon glyphicon-hand-right">&nbsp;</span>Signup
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
			</div>	
		</div>
</div>

<!--here include the footer -->
<?php
include("../includes/footer.php")
?>