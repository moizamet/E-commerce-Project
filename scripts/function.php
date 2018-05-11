<?php
session_start();
ob_start();
$plzlog;
$functiontest='function added';
function logedin()
{
	
	if (isset($_SESSION['admin']) && !empty($_SESSION['admin']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function userlogedin()
{
	if (isset($_SESSION['user'])&&!empty($_SESSION['user']))
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>