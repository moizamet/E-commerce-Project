<?php
require_once 'scripts/function.php';
require_once 'scripts/database_connect.php';
$msg=null;
$empty=null;
if (isset($_SESSION['cart'])&&!empty($_SESSION['cart']))
{
$itemList=$_SESSION['cart'];
foreach ($itemList as $itemId => $itemQty) {
	echo $itemId." qty : ".$itemQty."</br>";
	if (isset($_SESSION['uid'])&&!empty($_SESSION['uid']))
	{
	$q="INSERT into project_order values(NULL,?,?,?,now())";
	echo $_SESSION['uid'];
		$uid=$_SESSION['uid'];
		$stmt=mysqli_prepare($con,$q);
		$stmt->bind_param('iii',$uid,$itemId,$itemQty);
		if ($stmt->execute())
		{
			echo 'Added successfully !';
		}
		else
		{
			echo 'Failed !!!!';
		}
	}
	else
	{
		$msg="Please Login to Complete your Order";
	}
	


}
}
else
{
	$empty="Your Cart seems to be empty or Not Loged In !";
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

	<div class="jumbotron" style="font-size:30px;background-color:#af2; border:5px solid #7c2">
	<?php
	if ($msg)
	{
	 	echo $msg;
	 	echo '</br><a  href="user_login.php" class="btn btn-default btn-lg" ><span class="fa fa-user"></span> &nbsp; &nbsp;Login </a>';
	}
	else if ($empty)
	{
		echo $empty;
	}
	
	else
	{
		echo 'Order Placed Successfully !.</br>Your Order is Preparing to Be Delivered Soon...
		<br/><div align="center" style="margin-top:20px;">';
	}
	?>
	</br>
	<a  href="product_list.php" class="btn btn-default btn-lg" ><span class="fa fa-arrow-left"></span> &nbsp; &nbsp;Continue Shopping </a></div>

	</div>
	</div>
	<div class="footer"><?php include 'style/userpage_footer.php';?></div>

</div>
</div>
</body>
</html>