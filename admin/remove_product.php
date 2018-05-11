<?php
require_once '../scripts/database_connect.php';
require_once '../scripts/function.php';
if (isset($_GET['cnfrmdel']))
{
$pid=$_GET['cnfrmdel'];

$query="SELECT image FROM project_product WHERE id=?";
$stmt=mysqli_prepare($con,$query);
$stmt->bind_param('i',$pid);

if ($stmt->execute())
// if (1)

{

	$stmt->bind_result($img);
	$stmt->fetch();

	$path=('../Images/'.$img);
	//echo 'imag '.$path;
	if (file_exists($path))
	{
		unlink($path);
		echo 'removed !! ';
	}
	else
	{

	}
	mysqli_close($con);
	$con=mysqli_connect('localhost','root','winserver','Learn') or die('Cannot connect');
	
	echo $pid;
	$query="DELETE FROM project_product WHERE id=".$pid;
	
	//$statementdel=mysqli_prepare($con,$query);
	//var_dump($statementdel);
	//$statementdel->bind_param('i',$pid);

	if (mysqli_query($con,$query))
	{
		echo 'Deleted ';
		header('Location: manage_product.php');
	}
	else
	{
		echo mysqli_error($con);
	}
	

}
else
{
	echo 'database prob';
}

mysql_close();

}
?>