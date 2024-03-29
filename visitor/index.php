<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<link rel="stylesheet" href="../server_files/css/mycss.css?1422585377" type="text/css"/>
	<!-- <link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css"> -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body style="margin: 0px;" onload="initialize()" onresize="initialize()">
	<div class="slide-item" style="background-image:url(../server_files/images/park2.jpg);background-repeat:no-repeat;background-position:left top;background-size:cover;height: 100%; position: fixed;float:all;width: 100%; opacity: 1;"></div>
	<div id = "nav-placeholder">
	
</div>


<ul id="primary_nav" class = "hiddenm"> 

		<li class="active interactive">
			<a id = "menu_control" href="javascript:void(0);" onclick="expand()">
				<i class="fa fa-bars"></i>
			</a>
		</li>

		<li class="current-menu-item">
			<a href="#">Home</a>
		</li>
		<li class="active">
			<a href="#shows">Shows</a>
		</li>
		<li class="active">
			<a href="#attractions">Attractions</a>
		</li>
		<li class="active">
			<a href="#info">Contact US</a>
		</li>

	</ul>


<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>

	<section id = "Get Started">
		<div class = "component-wrapper">
			<div class = "fullscreen" style="background-color: rgba(236, 255, 238, 0.4)">
				<div id= "head-line-container">
					<h1 id="head-line"> Welcome to Hello World</h1>
					<div class="row">
							<a id = "greenB" class= "generalButton" href = "../signup"> Sign Up</a>
						<a id = "blueB" class= "generalButton" href = "../login" > Log In
						</a>
					</div>
				</div>
			</div>
		</div>

	</section>

<section id = "info" >
	<div class="simple-chord--wrapper component-wrapper" style="background-color: rgba(100,100,100,0.7);">
		<div class="simple-chord--inner" style="opacity: 1; color: white">
			<div class="h-font h2">Contact Us</div>
			<div class="simple-chord--text body-text">
				<div> 
					<div>E-mail: &nbsp;<a class= "emaillink" href="mailto:abcd@gmail.com">&nbsp;&nbsp; abcd@gmail.com</a>
					</div>
					<div> Phone: &nbsp;&nbsp; (123)456-7890</div>
					<div><br></div>2205 Lower Mall<br>
					<div> Vancouver, BC, Canada</div>
					<div>V6T1Z4<br></div> 
				</div>
			</div>
		</div>
	</div>

</section>

<div class="component-wrapper">
	<div style="background-color: rgba(0,0,0,1);width: 100%">

		<div class="footer">

			<div>
				<div style="text-align: center; color: white;">
				</div>
			</div>
			<div class="links">
				<a  href="https://github.com/ZijiaZhang99">
					<img src = "../server_files/icons/github-circle.png" >
				</a>
			</div>
		</div>
	</div>
</div>

</body>




</html>
