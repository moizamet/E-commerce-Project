<?php
require_once '../scripts/function.php';
require_once '../scripts/database_connect.php';


?>

<div id="page_header">
	<div class="jumbotron">
		<h2 style="font-family:times new roman;font-size:54px;font-weight:bold;color:#9a5d2b">E-COMMERCE WEBSITE</h2>
	</div>
	<nav class="navbar navbar-inverse">
	
	<ul class="nav navbar-nav">
		<li ><a href="index.php">Home</a></li>

	</ul>
	<!-- <div align="right"> <a href="logout.php">Logout</a> </div> -->
	<?php
	
	if (logedin())
	{
		echo '<div align="right" style="font-size:24px;margin:5px;margin-right:20px;"> <a href="admin_logout.php">Logout</a> </div>';
	}
	?>
	</nav>
	

</div>