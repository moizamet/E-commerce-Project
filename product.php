<?php
require_once 'scripts/function.php';
require_once 'scripts/database_connect.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title> Moiz Php Project</title>
	<link rel="stylesheet" a href="style/Bootstrapfiles/css/bootstrap.min.css">


</head>
<body>
<div class="container"> 
<div class="mainwrap">
	<div class="head"><?php include 'style/userpage_header.php'; ?></div>
	<div class="content">
	<div class="row">
	<div class="col-lg-3" >
		<?php
		require 'style/user_left.php';
		?>
	</div>
	<div class="col-lg-9">
		<h2 align="center"><b> Product Detail </b> </h2>
		<?php
		function getProduct()
		{	
			$con=connect_database();
			$query="SELECT * FROM project_product where id=? ";
			// $con=connect_database();
			$pid=$_GET['pid'];
			$stmt=mysqli_prepare($con,$query);
			$stmt->bind_param('i',$pid);
			$response=$stmt->execute();
			if ($response)
			{
				$stmt->store_result();
				if ($stmt->num_rows()==1)
				{
					$stmt->bind_result($id,$name,$price,$detail,$category,$image,$date);
					$stmt->fetch();
					
					echo '<div style="margin:5px;background-color:#abcdef;border:5px solid #3bc;border-radius:10px; padding:10px; font-size:22px;font: italic 20px/30px Georgia, serif;">
				<div class="row">
				<div class="col-lg-4" style="border-right:2px solid black "> 
					<div align="center" 
					style="background-color:white;padding:10px;width:110% ">
					<a href="Images/'.$image.'"><img  src="Images/'.$image.'" alt="image" 
					height="250px" width="250px"></a>
					</div>
				</div>
				<div class="col-lg-8">
					<div align="center" style="font-size:40px;"><b> '.$name.' </b></div>
					<hr>
					<div class="float:right">
						<div align="Left" style="font-size:20px;margin-top:30px;float:left">Price &bull;<b> Rs. '.$price.' </b></div>
						<div align="right" style="float:right;font-size:20px;margin-top:30px;">Added on  &bull; <b> '.$date.' </b></div>
						<div>&nbsp; &nbsp;</div>
						<div>&nbsp; &nbsp;</div>

					</div>
					
					<div  style="font-size:20px;margin-top:30px;">Category  &bull; <b> '.$category.' </b></div>
					<div  style="font-size:20px;margin-top:30px;">Details  &bull; <b> '.$detail.' </b></div>
					<div align="right"><a href="cart.php?pid='.$id.'" class="btn btn-primary btn-lg"> Add to Cart</a></div>

				 </div>
				 

				</div>
				</div>
			
	</div>';
				}
				else
				{
					echo '<p style="font-size:25px;">Something wrong, cannot fetch product at this moment</p>';
				}

			}
			else
			{
				mysqli_error();
			}
	
		}
		getProduct();
			close_database();
		?>	

		
		
			
		<!-- <div class="col-lg-2">
		
	</div> -->
	</div>
	</div>
	</div>
	<div class="footer"><?php include 'style/userpage_footer.php';?></div>

</div>
</div>
</body>
</html><?php

?>




