<?php
require_once 'scripts/function.php';
require_once 'scripts/database_connect.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title> Moiz Php Project</title>
	<link rel="stylesheet" a href="style/Bootstrapfiles/css/bootstrap.min.css">

	<style type="text/css">
	ul.products li{
		width: 200px;
    display: inline-block;
    vertical-align: top;
    display: inline;
    zoom: 1;
    float:left;
	}
	</style>
</head>
<body>
<div class="container">
<div class="mainwrap">
	<div class="head"><?php include 'style/userpage_header.php'; ?></div>
	<div class="content">
	<div class="row">
	<div class="col-lg-3">
		<?php 
		include 'style/user_left.php';
		 ?>
	</div>
	<div class="col-lg-9 ">
		<h2 align="center"> Product List </h2>
		<?php
		$con=connect_database();
		$query="SELECT * FROM project_product WHERE category='Electronics'";
		$response=mysqli_query($con,$query);
		if ($response)
		{
			while($product=mysqli_fetch_array($response))
			{

					echo '	<div class="col-lg-5 jumbotron" style="margin:10px;background-color:#ccc;padding:10px; font-size:22px;font: italic 20px/30px Georgia, serif;">
								<div align="center" style="background-color:white;padding:10px;width:95% "><img  src="Images/'.$product['image'].'" alt="image" height="250px" width="200px"></div>
								<div align="center" ><b> '.$product['product_name'].'</b></div> 
								<div align="center" >  Rs.'.$product['price'].'</div>	
								<div align="center"> <a href="product.php?pid='.$product['id'].'"> View Detail </a> </div>
							</div>'
							;

					
				}
			}
			else
			{
				mysqli_error();
			}

		close_database();
		
		?>	

	</div>
		
	</div>
	</div>
	<div class="footer"><?php include 'style/userpage_footer.php';?></div>

</div>
</div>
</body>
</html>