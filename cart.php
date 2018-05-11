<?php
require_once 'scripts/function.php';
require_once 'scripts/database_connect.php';

if (isset($_GET['pid'])&& !empty($_GET['pid']))
{	$valid=false;
	$con=connect_database();
	$pid=$_GET['pid'];
	$query="select * from project_product where id=?";
	$stmt=mysqli_prepare($con,$query);
	$stmt->bind_param('i',$pid);
	$response=$stmt->execute();
	if ($response)
	{
		$stmt->store_result();
		if ($stmt->num_rows()==1)
		{

			$valid=true;
		}
		else
		{
			echo 'Product not Available ! Sorry';
		}
	}
	else
	{
		mysqli_error();
		echo 'cannot connect to database';
	}

	if ($valid)
	{
		if (isset($_SESSION['cart'])&&!empty($_SESSION['cart']))
		{
			foreach ($_SESSION['cart'] as $key => $value) 
			{
				if ($key==$pid)
				{
					$_SESSION['cart'][$key]=$_SESSION['cart'][$key]+1;
					break;
				}
			}
			
			if (!($key==$pid))
			{
			
			$_SESSION['cart'][$pid]=1;

			}
		}
		else
		{
			$_SESSION['cart']=array($pid=>1);
		}

		// print_r($_SESSION['cart']);
		header('Location:cart.php');

	}


	close_database();
}

if (isset($_GET['removeitem'])&&!empty($_GET['removeitem']))
{
	if (is_numeric($_GET['removeitem']))
	{
			$rid=($_GET['removeitem']);
			if (count($_SESSION['cart'])==1&&!empty($_SESSION['cart'][$rid]))
			{
				session_destroy();
				// echo 'Empty cart';
			}
			else
			{
				unset($_SESSION['cart'][$rid]);
				// print_r($_SESSION['cart']);
			}
			header('Location:cart.php');

	}
	else
	{

	}
	
}

if (isset($_GET['ecart'])&&!empty($_GET['ecart']))
{
	$v=$_GET['ecart'];
	if ($v==1)
	{
		if (isset($_SESSION['cart'])&&!empty($_SESSION['cart']))
		{
			session_destroy();
		}
		header('Location: cart.php');
	}
}

if (isset($_GET['id'])&&isset($_GET['quan'])&&!empty($_GET['id'])&&!empty($_GET['quan']))
{
	$pid=$_GET['id'];
	$quantity=$_GET['quan'];
	if (is_numeric($quantity)==false || $quantity<1)
	{
		$quantity=1;
	}
	$quantity=round($quantity);
	if ($quantity>99){$quantity=99;}
	if(!empty($_SESSION['cart']))
	{
		$_SESSION['cart'][$pid]=$quantity;
		header('location: cart.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Moiz Php Project</title>
	<link rel="stylesheet" a href="style/Bootstrapfiles/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/font-awesome/css/font-awesome.min.css">


</head>
<body>
<div class="container">
<div class="mainwrap">
	<div class="head"><?php include 'style/userpage_header.php'; ?></div>
	<div class="content">
		<div class="row">
	<div class="col-lg-2" >
		
	</div>
	<div class="col-lg-10">
		<h2 align="center"><b> Your Shopping Cart </b> </h2>
		<div class="jumbotron " >
		<ul class="nav nav-stacked ">
			<script type="text/javascript">
function myfunction(id)
{
	
	quantity=document.getElementById('changed_quantity'+id).value;
	window.location="cart.php?id="+id+"&quan="+quantity;

}
</script>
			<?php
			$con=connect_database();
			if (isset($_SESSION['cart'])&&!empty($_SESSION['cart']))
			{
				echo '<li>
				<div class="row" style="font-size:18px;text-align:center">
					<div class="col-lg-2"><b>Name</b></div>
					<div class="col-lg-3"><b>Image</b></div>
					<div class="col-lg-1"><b>Quantity</b></div>
					<div class="col-lg-2"><b>Price</b></div>
					<div class="col-lg-2"><b>Total</b></div>
					<div class="col-lg-2"><b>Options</b></div>
				</div>
			</li>';
				$items=$_SESSION['cart'];
				$sno=1;
				$total=0;
				foreach($items as $pid=>$quantity)
				{
					$query="SELECT product_name,price,image FROM project_product where id=?";
					$stmt=mysqli_prepare($con,$query);
					$stmt->bind_param('i',$pid);
					$response=$stmt->execute();
					if ($response)
					{
						$stmt->bind_result($name,$price,$image);
						$stmt->fetch();
						while($stmt->fetch()){
							
						}
						echo '	<li>
						<div class="row" style="text-align:center">
						<div class="col-lg-2" style="font-size:20px;">'.$sno++.'.<a href="product.php?pid='.$pid.'"> '.$name.'</a> </div>
						<div class="col-lg-3"><img src="Images/'.$image.'" width=190px; height=200px;></div>
						<div class="col-lg-1"><input type="text" value="'.$quantity.'" id="changed_quantity'.$pid.'" onchange="myfunction('.$pid.')"  style="width:50px;"></div>
						<div class="col-lg-2">'.$price.'</div>
						<div class="col-lg-2">'.$price*$quantity.'</div>
						<div class="col-lg-2"><a href="cart.php?removeitem='.$pid.'" > Remove </a> </div>
						</div>
					</li> <hr>';
					$total+=$price*$quantity;
					}
					else
					{
						echo 'Cannot fetch item at this moment';
					}
				}

				echo '<div align="right"><h3 style="color:#258;font-weight:bold"> Total items : '.($sno-1).'</h3></div><div align="right"><h3 style="color:#258;font-weight:bold"> Total ammount : Rs.'.$total.'</h3></div>';
			}
			else
			{
				echo '<h2> It Seems your Cart is Empty. Enjoy Shopping :) </h2>';

			}
			
			?>

		</ul>
		</div>
		<div>
			<a  href="product_list.php" class="btn btn-warning btn-lg"><span class="fa fa-arrow-left"></span> &nbsp; &nbsp;Continue Shopping </a>
			<a  align="center" href="cart.php?ecart=1" class="btn btn-danger btn-lg col-lg-offset-2"> <span class="fa fa-trash-o "> </span> &nbsp; &nbsp;Empty Cart </a>
			<a align="right" href="deliver.php" class="btn btn-success btn-lg col-lg-offset-2"> Proceed to checkout &nbsp; &nbsp;<span class="fa fa-arrow-right"></span>  </a>
		</div>
	</div>

	</div>
	</div>
	<div class="footer"><?php include 'style/userpage_footer.php';?></div>

</div>
</div>
</body>
</html>