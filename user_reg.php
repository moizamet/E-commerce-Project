<?php
require_once 'scripts/function.php';
require_once 'scripts/database_connect.php';

$msg="";

if (isset($_POST['submit1'])&&isset($_POST['name'])&&!empty($_POST['name']))
{
	$name=$_POST['name'];
	$uname=$_POST['uname'];
	$pass=$_POST['pass'];
	$gender=$_POST['gender'];
	$con=connect_database();
	$query="SELECT * FROM project_user WHERE username=?";
	$stmt=mysqli_prepare($con,$query);
	$stmt->bind_param('s',$uname);
	if ($stmt->execute())
	{
		$stmt->store_result();
		if ($stmt->num_rows()==0)
		{
			$query="INSERT INTO project_user VALUES (NULL,?,?,?,?)";
			$stmt=mysqli_prepare($con,$query);
			$stmt->bind_param('ssss',$uname,$pass,$name,$gender);
			$response=$stmt->execute();
			if ($response)
			{
				if(mysqli_stmt_affected_rows($stmt)==1)
				{
					header('Location:user_login.php');
				}
			}
			else
			{
				$msg="cannot connect to database ";
			}
		}
		else
		{
			$msg="Username already Exists !!";
		}
	}
	else
	{
		$msg="cannot connect to database ";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Moiz Php Project</title>
	<link rel="stylesheet" a href="style/Bootstrapfiles/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/font-awwesome/css/font-awesome.min.css">
</head>
<body>
<div class="container">
<div class="mainwrap">
	<div class="head"><?php include 'style/userpage_header.php'; ?></div>
	<div class="content row">
		

		<div class="jumbotron col-lg-6 col-lg-offset-3" style="background-color:grey;padding:10px;">
			<h2 align="center">User Registration</h2>
			<form action="user_reg.php" method="POST" class="form-horizontal " enctype="multipart/form-data">
				<div class="form-group">
				<label class="col-lg-3 control-label "> Name </label>
				<div class=" col-lg-6">
				<input type="text" name="name" placeholder="eg. Moiz Amet" class="form-control" onkeypress='return !(event.charCode >= 48 && event.charCode <= 57)' required>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Username  </label>
				<!-- <label class="col-lg-1 control-label ">Rs. </label> -->
				<div class=" col-lg-6 ">
				<input type="text" name="uname" placeholder="eg. moizamet" class="form-control" required>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Password </label>
				<div class=" col-lg-6">
				<input type="password" name="pass"  class="form-control" required >
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Gender </label>
				<div class=" col-lg-5">
				<input type="radio" name="gender" value="male"> &nbsp;Male
				<input type="radio" name="gender" value="female" required > &nbsp;Female
				</div>
				</div>
				
							

				<p style="font-size:16px;font-weight:bolder" class="col-lg-offset-3"><?php echo $msg; ?></p>
				<div  align="center">
					<input type="submit" value="Register " name="submit1" class="btn btn-lg btn-primary">
				</div>
				</form>
		</div>


	</div>
	<div class="footer"><?php include 'style/userpage_footer.php';?></div>

</div>
</div>
</body>
</html>