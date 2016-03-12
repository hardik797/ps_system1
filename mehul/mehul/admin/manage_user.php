<!--include header -->
<?php
include("../includes/session.php");
include("../includes/header.php");
/*if(isset($_SESSION['user']))
{*/


?>

	<nav class="nav navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Admin</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Page</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>
					<?php  echo "Welcome ".ucfirst($_SESSION['user']); ?></a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid content">
		<h2 class="text-center">Manage user </h2>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
				<?php 
				$result1 = get_rows("select id, first_name, last_name, email, user_name, password, country, state, city, address_line1, address_line2, zipcode from  user_registration");
				echo "<table class='table table-bordered'>";
				echo "<thead><tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Username</th><th>Password</th><th>Country</th><th>State</th><th>City</th><th>Address</th><th>Zipcode</th>
					<th>Edit</th><th>Delete</th></tr></thead><tbody> ";
				foreach ($result1 as $row) 
				{
					echo"<tr>";
					echo"<td>".$row['first_name']."</td>";
					echo"<td>".$row['last_name']."</td>";
					echo"<td>".$row['email']."</td>";
					echo"<td>".$row['user_name']."</td>";
					echo"<td>".$row['password']."</td>";
					echo"<td>".$row['country']."</td>";
					echo"<td>".$row['state']."</td>";
					echo"<td>".$row['city']."</td>";
					echo"<td>".$row['address_line1'].$row['address_line2']."</td>";
					echo"<td>".$row['zipcode']."</td>";
					echo"<td><a href='edit.php?id=".$row['id']."'>Edit</a></td>";
					echo"<td><a href='edit.php?id=".$row['id']."'>Delete</a></td>";
				}
				echo"</tbody></table>"
				?>
				</div>
			</div>
		</div>
		
	</div>
	<div class="container-fluid text-center footer">
		<p>All &copy;&nbsp;copyright reserved</p>
	</div>

<!--here include the footer -->
<?php
include("../includes/footer.php");
/*}
else
{
	$_SESSION['errors'][] = "Please login first";
	header("location: login.php");
}
*/
?>