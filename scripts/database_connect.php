<?php

define('HOST','localhost');
$dbuser='root';
$dbpas='winserver';
$db='learn';

$con=mysqli_connect(HOST,$dbuser,$dbpas,$db) or die('Cannot connect to database');
function connect_database()
{
	global $dbuser,$dbpas,$db;
	$con=mysqli_connect(HOST, $dbuser,$dbpas,$db) or die('Cannot connect to database');
	return $con;	
}

function close_database()
{
	global $con;
	mysqli_close($con);
}
$copyri="Moiz Amet";
define('Owner','Moz Amet');
$v='hello';


?>