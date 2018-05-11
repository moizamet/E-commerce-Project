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

if (isset($_GET['pid']))
{ // Edited Data input
	$pid=$_GET['pid'];
	$query="SELECT * FROM project_product WHERE id=?";
	$stmt=mysqli_prepare($con,$query);
	$stmt->bind_param('i',$pid);
	$response=$stmt->execute();
	if ($response)
	{
		$stmt->store_result();
		if ($stmt->num_rows()==1)
		{
			$stmt->bind_result($id,$name,$price,$detail,$category,$image,$daded);
			$stmt->fetch();

		}
		else
		{
			echo 'invalid result';
		}
	}
	else
	{
		
		echo mysqli_error();
	}
}

if (isset($_POST['product_name']) && !empty($_POST['product_name']))
{
	$image=$_POST['images'];
	if(isset($_FILES['fileimage']['name'])&& !empty($_FILES['fileimage']['name']))
	{
		$tmpname=$_FILES['fileimage']['tmp_name'];
		$tmpname=substr($tmpname,strpos($tmpname, '/')+1);
		$tmpname=substr($tmpname,strpos($tmpname, '/')+1);
		
		$image=$tmpname.$_FILES['fileimage']['name'];
		move_uploaded_file($_FILES['fileimage']['tmp_name'],'../Images/'.$image);
	}
	$name=$_POST['product_name'];
	$price=$_POST['price'];
	$detail=$_POST['detail'];
	$category=$_POST['category'];
	$id=$_POST['iid'];
	
	$query="UPDATE project_product set product_name=?,price=?,detail=?,category=?,image=? where id=?";
	$stmt=mysqli_prepare($con,$query);
	$stmt->bind_param('sssssi',$name,$price,$detail,$category,$image,$id);
	$response=$stmt->execute();
	if ($response)
	{
		echo 'updated successfully';
		if (mysqli_stmt_affected_rows($stmt)==1)

		{
			echo 'final updated successfully';
			header('Location: manage_product.php');

		}
		else
		{
			echo 'Invalid Record';
		}
	}
	else
	{
		mysqli_error();
		echo 'Cannot update record at this moment';
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

<div class="jumbotron" style="background-color:#1592ad;padding:10px;font-size:18px;">
<div><h2 align="center"><b>Manage Inventories</b></h2></div>
	
<div class="row">
	<?php include '../style/leftsidepane.php' ?>
	

	<div class="col-lg-3"></div>
				<a name="inventoryform" ></a>
				<div class="jumbotron col-lg-8" style="background-color:#159bdf;padding:10px;margin-left:22px;" >
				<div class="jumbotron" style="background-color:black">
			<h2 align="center"><b>Edit Product</b></h2>
				<form action="product_edit.php" method="POST" class="form-horizontal " enctype="multipart/form-data">
				<div class="form-group">
				<label class="col-lg-3 control-label ">Product Name </label>
				<div class=" col-lg-9">
				<input type="text" name="product_name" placeholder="Product Name" value="<?php echo $name?>" class="form-control" required>
				</div>
				</div>
				<input type="hidden" value="<?php echo $id ?>" name="iid">
				<input type="hidden" value="<?php echo $image ?>" name="images">
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Price  </label>
				<!-- <label class="col-lg-1 control-label ">Rs. </label> -->
				<div class=" col-lg-4 ">
				<input type="number" name="price" placeholder="Rs." value="<?php echo $price?>" class="form-control" required>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Detail </label>
				<div class=" col-lg-9">
				<textarea type="text-area" name="detail"   class="form-control"> <?php echo $detail ?></textarea>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-lg-3 control-label ">Category </label>
				<div class=" col-lg-5">
				<select class="form-control"  name="category">
					<option value="<?php echo $category?>"> <?php echo $category?> </option>
					<option value="Clothes"> Clothes </option>
					<option value="Education"> Education </option>
					<option value="Electronics"> Electronics </option>
					<option value="Footware"> Footware </option>
					<option value="Household"> Household </option>

				</select>
				</div>
				</div>
				<div class="col-lg-offset-3" style="margin-bottom:10px">
					<img src="<?php echo '../Images/'.$image; ?>" width="200px" height="150px">
				</div>
				<div class="form-group">
				<label class="col-lg-3 control-label ">Image </label>
				<div class=" col-lg-3">
				<input type="file" value="<?php echo $image ?>" name="fileimage"  >
				</div>
				</div>
				

				<p style="font-size:16px;font-weight:bolder" class="col-lg-offset-3"><?php echo $msg; ?></p>
				<div class="col-lg-offset-3">
					<input type="submit" value=" Update Record " name="submit1" class="btn btn-md btn-primary">
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