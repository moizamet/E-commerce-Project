<?php
require_once '../scripts/function.php';

session_destroy();
if(isset($_SERVER['HTTP_REFERER'])&&!empty($_SERVER['HTTP_REFERER']))
{
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
else
{
	header('Location: index.php');
}
?>