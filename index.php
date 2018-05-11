<!DOCTYPE html>
<html>
<head>
	<title> Moiz Php Project</title>
	<link rel="stylesheet" a href="style/Bootstrapfiles/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/font-awwesome/css/font-awesome.min.css">
	<style type="text/css">
	.slide2{
			background-image: url('style/front/22.jpg');
			height: 400px;
			
			background-size: cover;
			
		}
		.slide3{
			background-image: url('style/front/22.png');
			height: 400px;
			
			background-size: cover;
			
		}
		.slide1{
			background-image: url('style/front/11.png');
			height: 400px;
			
			background-size: cover;
			
			;
		}
	</style>
</head>
<body>
<div class="container">
<div class="mainwrap">
	<div class="head"><?php include 'style/userpage_header.php'; ?></div>
	<div class="content">
		<!-- echo Moiz Amet -->
		
		 <div id="theCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#theCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#theCarousel" data-slide-to="1"></li>
			<li data-target="#theCarousel" data-slide-to="2" ></li>
		</ol>
		<div class="carousel-inner">
		<div class="item active">
		<div class="slide1"></div>
		<div class="carousel-caption"> 
		</div> </div>
	

	
		<div class="item">
		<div class="slide2"></div>
		<div class="carousel-caption"> 
		</div> </div>
	

	
		<div class="item">
		<div class="slide3"></div>
		<!-- <div class="myback"></div> -->
		<div class="carousel-caption"> 
		</div> 
	</div>
	</div>

	<a class="left carousel-control" href="#theCarousel" data-slide="prev">
	<span class="glyphicon glyphicon-chevron-left"></span></a>

	<a class="right carousel-control" href="#theCarousel" data-slide="next">
	<span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
		<!-- crousel end -->


		<!-- new crousel for data -->
		<!-- end of second crousel -->
		<div class="container">
		<a href="cat_electronics.php">
		<h1> Electronics  </h1>

			<img src="style/page/1.jpg" height="400px" width="1100px">
			</a>
		</div>
		<hr>
		<div class="container">
		<a href="cat_trend.php">
		
		<h1> Latest Trends  </h1>

			<img src="style/page/clothes.jpg" height="400px" width="1100px">
			</a>
		</div>
		<hr>
		<div class="container">
		<a href="cat_footware.php">
		<h1> Footwear  </h1>

			<img src="style/page/footware.jpg" height="400px" width="1100px">
			</a>
		</div>
		
				
		<div class="container">
		<a href="cat_education.php">
		<h1> Stationery  </h1>

			<img src="style/page/education.jpg" height="400px" width="1100px">
			</a>
		</div>

		<div class="container">
		<a href="cat_household.php">
		<h1> Household  </h1>

			<img src="style/page/house.jpg" height="400px" width="1100px">
			</a>
		</div>		
<!-- echo Moiz Amet -->

	</div>
	<div class="footer"><?php include 'style/userpage_footer.php';?></div>

</div>
</div>


<script src="style/Bootstrapfiles/css/jquery_2.1.3_jquery.min.js"></script>
<script src="style/Bootstrapfiles/js/bootstrap.min.js"></script>
</body>

</html>
<!-- <?php //echo Moiz Amet ?>-->