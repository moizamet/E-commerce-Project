<?php
require_once '../scripts/database_connect.php';
require_once '../scripts/function.php';
$msg='';
if (logedin())
{
	header('Location: index.php');
}
else
{
	if (isset($_POST['uname'])&&isset($_POST['upass']))
	{
		$uname=$_POST['uname'];
		$pass=$_POST['upass'];
		if (!empty($uname)&&!empty($pass))
		{
			$query="SELECT id,name FROM project_admin WHERE username=? and password=?";
			$statement=mysqli_prepare($con,$query);
			$statement->bind_param('ss',$uname,$pass);
			$response=$statement->execute();
			$statement->store_result();
			
			if ($response)
			{

				 
				if (mysqli_stmt_num_rows($statement)==1)
				{
					$statement->bind_result($id,$name);
					$statement->fetch();
					// echo $name;
					
						$_SESSION['admin']=$name;
						$_SESSION['aid']=$id;
					

					header('Location: index.php');
				}
				else
				{
					$msg='Incorrect Username Password !';
				}
			}
			else
			{
				$msg='Cannot Log in at this moment';
			}

		}
		else
		{
			$msg= 'Please enter username and password !!';
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title> Moiz Php Project</title>
	<link rel="stylesheet" a href="../style/Bootstrapfiles/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="mainwrap">
	<div class="head"><?php include '../style/page_header.php'; ?></div>
	<div class="content">

<div class="jumbotron col-lg-8 col-lg-offset-2" style="background-color:grey;padding:10px;">
<h2 align="center">Admin Log in</h2>
	<form action="admin_login.php" method="POST" class="form-horizontal col-sm-offset-4">
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
		<input type="submit" value="Login" class="btn btn-md btn-primary">
	</div>
	</form>
</div>
		
	</div>
	<div class="footer"><?php include '../style/page_footer.php';?></div>

</div>
</div>
</body>
</html>