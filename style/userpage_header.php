<?php
require_once 'scripts/function.php';
require_once 'scripts/database_connect.php';


?>
<link rel="stylesheet" type="text/css" href="style/font-awesome/css/font-awesome.min.css">
<div id="page_header">
	<div class="jumbotron" style="padding:30px;border:2px solid #abc">
		<p style="font-size:20px;" class="pull-right"> Welcome <?php if(isset($_SESSION['user'])&&!empty($_SESSION['user'])){ echo '<b>'.$_SESSION['user'].'</b>';}  ?></p>
		<h2 style="font-family:times new roman;font-size:54px;font-weight:bold;color:#9a5d2b">E-COMMERCE WEBSITE</h2>
	</div>
	<nav class="navbar navbar-inverse">
	
	<ul class="nav navbar-nav" style="font-size:15px;">
		<li ><a href="index.php">Home &nbsp;<span class="fa fa-home fa-2x"> </span></a></li>
		<li><a href="product_list.php">Product List &nbsp;<span class="fa fa-shopping-bag fa-2x"> </span> </a></li>
		<li><a href="cart.php"> My Cart &nbsp; <?php 
		if (isset($_SESSION['cart'])&&!empty($_SESSION['cart']))
		{
			$l=count($_SESSION['cart']);
			echo '<span class="badge">'.$l.'</span>';
		}
		?>&nbsp; <span class="fa fa-cart-arrow-down fa-2x"> </span> </a></li>
		<?php 
		if (!userlogedin())
		{
		?>
		<li ><a href="user_reg.php">Register &nbsp;<span class="fa fa-user-plus fa-2x"> </span> </a></li>
		<li ><a href="user_login.php">Login &nbsp;<span class="fa fa-user fa-2x"> </span> </a></li>
		<?php
		}
		?>

	</ul>
	
	<?php
	
	if (userlogedin())
	{
		echo '<div align="right" style="font-size:24px;margin:5px;margin-right:20px;"> <a href="user_logout.php">Logout&nbsp;<span class="fa fa-user "> </span> </a> </div>';
	}
	?>
	</nav>
	

</div>