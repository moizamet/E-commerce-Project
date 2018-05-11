<?php
require_once 'scripts/function.php';
require_once 'scripts/database_connect.php';

$msg="";
if (isset($_POST['reg'])&&isset($_POST['uname'])&&!empty($_POST['upass']))
{
	$uname=$_POST['uname'];
	$pass=$_POST['upass'];
	echo $uname.$pass;
	$con=connect_database();
	$query="SELECT id,name FROM project_user where username=? and password=?";
	$stmt=mysqli_prepare($con,$query);
	$stmt->bind_param('ss',$uname,$pass);
	$response=$stmt->execute();
	if ($response)
	{
		$stmt->store_result();
		if ($stmt->num_rows()==1)
		{
			$stmt->bind_result($id,$name);
			while($stmt->fetch())
			{
			$_SESSION['user']=$name;
			$_SESSION['uid']=$id;
			}
			header ('Location:index.php');
		}
		else
		{
			$msg="incorrect username or password !";
		}
	}
	else
	{
		$msg="cannot connect to server !!";
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
		

		<div class="jumbotron col-lg-8 col-lg-offset-2" style="background-color:grey;padding:10px;">
			<h2 align="center">User Log in</h2>
			<form action="user_login.php" method="POST" class="form-horizontal col-sm-offset-4">
				<div class="form-group">
					<label class="col-sm-2 control-label ">Username </label>
					<div class="col-sm-10 col-lg-6">
					<input type="text" name="uname" placeholder="username" class="form-control">
					</div>
					</div>
					<div class="form-group">
					<label class="col-sm-2 control-label ">Password </label>
					<div class="col-sm-10 col-lg-6">
					<input type="password" name="upass" placeholder="password" class="form-control">
					</div>
					</div>
					<p style="font-size:16px"><?php echo $msg; ?></p>
					<div class="col-lg-offset-2">
						<input type="submit" name="reg" value="Login" class="btn btn-lg btn-primary">
				</div>
			</form>
		</div>


	</div>
	<div class="footer"><?php include 'style/userpage_footer.php';?></div>

</div>
</div>
</body>
</html>