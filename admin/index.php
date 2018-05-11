<?php
require_once '../scripts/database_connect.php';
require_once '../scripts/function.php';
logedin();
if (!logedin())
{
	$plzlog='Please Log in ..';
	header('Location: admin_login.php');
	die();
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

<div class="jumbotron" style="background-color:#1592ad;padding:10px;font-size:18px;">
<h2 align="center">Admin Pannel to Manage the Store</h2>	
<div class="row">
	<?php include '../style/leftsidepane.php' ?>
</div>

</div>
		
	</div>
	<div class="footer"><?php include '../style/page_footer.php';?></div>

</div>
</div>
</body>
</html>