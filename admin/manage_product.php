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
$msg='';
if (isset($_POST['product_name'])&&!empty($_POST['product_name']))
{// To Process the Form

	$name=$_POST['product_name'];
	$price=$_POST['price'];
	$detail=$_POST['detail'];
	$category=$_POST['category'];
	$file=$_FILES['fileimage']['tmp_name'];
	if (!($_FILES['fileimage']['type']=='image/jpeg')||($_FILES['fileimage']['type']=='image/png'))
	{
		
		$msg= 'Please Enter a Valid Image';

		
	}
	else
	{
	//echo "$name $price $detail $category $file";
	$tmpname=$_FILES['fileimage']['tmp_name'];
	$tmpname=substr($tmpname,strpos($tmpname, '/')+1);
	$tmpname=substr($tmpname,strpos($tmpname, '/')+1);
	
	$imagename=$tmpname.$_FILES['fileimage']['name'];
	move_uploaded_file($_FILES['fileimage']['tmp_name'],'../Images/'.$imagename);
	$query="INSERT INTO project_product VALUES(NULL,?,?,?,?,?,now())";
	$statement=mysqli_prepare($con,$query);
	$statement->bind_param('sssss',$name,$price,$detail,$category,$imagename);
	if ($statement->execute())
	{
		if (mysqli_stmt_affected_rows($statement)==1)
		{
			echo 'Product Added Successfully !!';
			header('Location: manage_product.php');
		}
		else
		{

		}
	}
	}
	
}
if (isset($_GET['delid']))
{ // to confirmation
	$id=$_GET['delid'];
	$my='<script type="text/javascript">
	v=confirm("do you want to Delete Product ?");
	if (v)
	{
		window.location="remove_product.php?cnfrmdel='.$id.'";
	}
	else
	{
		window.location="manage_product.php";

	}
	</script> ';

// '.$id.'
	echo 'script : ==  '.$my;
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
<div><h2 align="center">Manage Inventories</h2></div>
<div style="float:right;"><h3> <a style="color:white" href="#inventoryform">+ Add Inventory</a></h3></div>
	
<div class="row">
	<?php include '../style/leftsidepane.php' ?>
	
	<div class="well col-lg-8" style="margin-left:20px; float:left" >
	<ul class="nav  nav-stacked">

		<?php
		$query="SELECT * FROM project_product ORDER BY id desc";
		$result=mysqli_query($con,$query);
		if (mysqli_num_rows($result)>=1)
		{
			$count=1;
			while($product=mysqli_fetch_array($result))
			{
				
				echo '<li > <div>'.$count++.'.<b style="font-size:24px;"><u><i> 
				'.$product['product_name'].'</i></u></b> &nbsp;&nbsp;&nbsp; 
				( '.$product['date_added'].'&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp; 
				<div align=right><a href="product_edit.php?pid='.$product['id'].'">Edit</a> &bull; 
				<a href="manage_product.php?delid='.$product['id'].'">Remove</a>
				</div> </div></li>';
				echo '<hr>';
			}

		}
		else
		{
			echo '<h3> No Products in Store </h3>';
		}
		?>
		
	</ul>
	</div>

	<div class="col-lg-3"></div>
				<a name="inventoryform" ></a>
				<div class="jumbotron col-lg-8" style="background-color:#159bdf;padding:10px;margin-left:22px;" >
				<div class="jumbotron" style="background-color:black">
			<h2 align="center"><b>Product Registration</b></h2>
				<form action="manage_product.php" method="POST" class="form-horizontal " enctype="multipart/form-data">
				<div class="form-group">
				<label class="col-lg-3 control-label ">Product Name </label>
				<div class=" col-lg-9">
				<input type="text" name="product_name" placeholder="Product Name" class="form-control" required>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Price  </label>
				<!-- <label class="col-lg-1 control-label ">Rs. </label> -->
				<div class=" col-lg-4 ">
				<input type="number" name="price" placeholder="Rs." class="form-control" required>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Detail </label>
				<div class=" col-lg-9">
				<textarea type="text-area" name="detail"  class="form-control"></textarea>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Category </label>
				<div class=" col-lg-5">
				<select class="form-control" name="category">
					<option value="select"> Select </option>
					<option value="Clothes"> Clothes </option>
					<option value="Education"> Education </option>
					<option value="Electronics"> Electronics </option>
					<option value="Footware"> Footware </option>
					<option value="Household"> Household </option>


				</select>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Image </label>
				<div class=" col-lg-3">
				<input type="file" name="fileimage"  >
				</div>
				</div>
				

				<p style="font-size:16px;font-weight:bolder" class="col-lg-offset-3"><?php echo $msg; ?></p>
				<div class="col-lg-offset-3">
					<input type="submit" value="+ Add Product " name="submit1" class="btn btn-md btn-primary">
				</div>
				</form>
				</div>
			</div>



</div>
	</div>	
	</div>
	<div class="footer"><?php include '../style/page_footer.php';?></div>

</div>
</div>
</body>
</html>