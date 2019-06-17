<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type = "text/css" href="./server_files/css/mycss.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Muli:400,700|Overpass+Mono" rel="stylesheet">
</head>

<?php include "loader.php";?>

<body style="margin: 0px" onload="initialize()" onresize="initializeatt()">

	<div class="slide-item" style="background-image:url(./server_files/images/park.jpg);background-repeat:no-repeat;background-position:left top;background-size:cover;height: 100%; position: fixed;float:all;width: 100%; opacity: 1;"></div>
	<div id = "nav-placeholder">

	</div>
	<script>
		
		$(function(){
			$("#nav-placeholder").load("navbar.html");
			$("#nav-placeholder").show();
		});
	</script>


	<section id = "Get Started">
		<div class = "component-wrapper">
			<div class = "fullscreen" style="background-color: rgba(255,255,255,0.7)">
				<div id= "head-line-container">
					<h1 id="head-line"> Welcome to My Inn</h1>
					<div class="row">
						<a id = "UserLogin" class= "generalButton" href = "./signup">SIGN UP</a>
						<a href = "./login" id = "EmployeeLogin" class= "generalButton"> LOGIN
						</a>
					</div>
				</div>
			</div>
		</div>

	</section>


	<section id = "shows">
		<div class="component-wrapper " style="background-color: rgba(30,30,30,0.7)">
			<div style="height: 100px; width: 100%; padding: 0px;"></div>
			<div id = "attractions-background">
				<div class="att-outer">
					<h1 style="text-align: center;"> Shows </h1>

					<div style="width: 100%">
						<div class="Search">
							<svg style="display: none">
								<symbol id="magnify" viewBox="0 0 18 18" height="100%" width="100%">
									<path d="M12.5 11h-.8l-.3-.3c1-1.1 1.6-2.6 1.6-4.2C13 2.9 10.1 0          6.5 0S0 2.9 0 6.5 2.9 13 6.5 13c1.6 0 3.1-.6 4.2-1.6l.3.3v.8l5 5          1.5-1.5-5-5zm-6 0C4 11 2 9 2 6.5S4 2 6.5 2 11 4 11 6.5 9 11 6.5            11z" fill="#fff" fill-rule="evenodd"/>
								</symbol>
							</svg>

							<div class="search-bar">

								<input type="text" id = "search-show" class="input" placeholder="&nbsp;">
								<span class="label">Search</span>
								<span class="highlight"></span>

								<div class="search-btn">
									<a id = "" href="javascript:void(0);" onclick="filtershows()">
										<svg class="icon icon-18">
											<use xlink:href="#magnify"></use>
										</svg>
									</a>
								</div>

							</div>
							<div style="width: 100%">
								<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content; width:-moz-fit-content;">
									<input id = "showToday" type="checkbox" name = "onlyTodayShow"checked>Only Show Today
								</div>
							</div>
						</div>
						<div id = "showSpace" class = "contianer attractions attlist">
							<!--Space For Shows-->



						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<section id = "attractions">
		<div class="component-wrapper " style="background-color: rgba(30,30,30,0.7)">
			<div style="height: 100px; width: 100%; padding: 0px;"></div>
			<div id = "attractions-background">
				<div class="att-outer">


					<h1 style="text-align: center;"> Attractions </h1>

					<div style="width: 100%">
						<div class="Search">
							<svg style="display: none">
								<symbol id="magnify" viewBox="0 0 18 18" height="100%" width="100%">
									<path d="M12.5 11h-.8l-.3-.3c1-1.1 1.6-2.6 1.6-4.2C13 2.9 10.1 0          6.5 0S0 2.9 0 6.5 2.9 13 6.5 13c1.6 0 3.1-.6 4.2-1.6l.3.3v.8l5 5          1.5-1.5-5-5zm-6 0C4 11 2 9 2 6.5S4 2 6.5 2 11 4 11 6.5 9 11 6.5            11z" fill="#fff" fill-rule="evenodd"/>
								</symbol>
							</svg>

							<div class="search-bar">

								<input type="text" id = "search-attr" class="input" placeholder="&nbsp;">
								<span class="label">Search</span>
								<span class="highlight"></span>

								<div class="search-btn">
									<a id = "" href="javascript:void(0);" onclick="filter()">
										<svg class="icon icon-18">
											<use xlink:href="#magnify"></use>
										</svg>
									</a>
								</div>

							</div>
						</div>
						<div style="width: 100%">
								<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;width:-moz-fit-content;	">
									<input id = "attrRP" type="checkbox" name = "noRPAttr"checked>Exclude Repairing
								</div>
							</div>
						<div id = "attrSpace"  class = "contianer attractions attlist">
							<!--Reserve For Attractions-->
						</div>
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
					<a  href="https://github.com/ZijiaZhang">
						<img src = "./server_files/icons/github-circle.png" >
					</a>
				</div>
			</div>
		</div>
	</div>



	<script>
		function filter(){
			getAttractions();
			AOS.refresh();

		}

		function filtershows(){
			getShows();

		}



		function initialize(){
			// getShows();
			// getAttractions();
			initializeatt();

		}

		function initializeatt(){
			var x = document.getElementsByClassName("attelem");
			for(var t = 0; t< x.length;t++){
				var p = x[t].getElementsByTagName("tr");
				for(var i = 0 ; i<p.length ; i++ ){
					var m = x[t].clientheight;
					p[i].style.height = x[t].getElementsByClassName("attimg")[0].clientHeight/2 +"px";
				}	

				var date = new Date();

				var seconds = date.getSeconds();
				var minutes = date.getMinutes();
				var hour = date.getHours();

				var opentime = parseInt(x[t].getElementsByClassName("openTime")[0].innerText.split(":")[0],10)*100 + parseInt(x[t].getElementsByClassName("openTime")[0].innerText.split(":")[1],10);
				var closetime = parseInt(x[t].getElementsByClassName("closeTime")[0].innerText.split(":")[0],10)*100 + parseInt(x[t].getElementsByClassName("closeTime")[0].innerText.split(":")[1],10);



				if( opentime <= hour*100+minutes && hour*100+minutes <= closetime-100 ){
					x[t].getElementsByClassName("openTimehead")[0].className = "openTimehead tableisGood";
					x[t].getElementsByClassName("closeTimehead")[0].className = "closeTimehead tableisGood";
				}else if( opentime <= hour*100+minutes && hour*100+minutes <= closetime){
					x[t].getElementsByClassName("openTimehead")[0].className = "openTimehead tableisOk";
					x[t].getElementsByClassName("closeTimehead")[0].className = "closeTimehead tableisOk";
				}else {
					x[t].getElementsByClassName("openTimehead")[0].className = "openTimehead tableisnotOk";
					x[t].getElementsByClassName("closeTimehead")[0].className = "closeTimehead tableisnotOk";
				}



			/*var waitTime = parseInt(x[t].getElementsByClassName("waitTime")[0].innerText.split("min")[0],10);
			var v = x[t].getElementsByClassName("waitTimehead")[0];
			if(waitTime <= 20){
				
				v.className += " tableisGood";
			}else if(waitTime<40){
				v.className += " tableisOk"
			}else{
				v.className += " tableisnotOk"
			}*/

			var Status = x[t].getElementsByClassName("waitTime")[0].innerText;
			var v = x[t].getElementsByClassName("waitTimehead")[0];
			if(Status == "OPEN"){
				v.className = "waitTimehead tableisGood";
			}else{
				v.className = "waitTimehead tableisnotOk";
			}


		}
	}

	$('input[name=onlyTodayShow]').change(function(){
		getShows();
	});



	function getShows() {
		var today = $('input[name=onlyTodayShow]').is(':checked');
		var query = $('#search-show').val();
		$.post("./HomePagePhp/show.php", { today: today, show: query},
			function(data) {
				$('#showSpace').html(data);
				AOS.refreshHard();
			});
	}

	$('#attrRP').change(function(){
		getAttractions();
	});

	$('#search-attr').on('input',function(e){
		getAttractions();
	});

	function getAttractions() {
		var today = $('input[name=noRPAttr]').is(':checked');
		var query = $('#search-attr').val();
		$.post("./HomePagePhp/attractions.php", { today: today, attr: query},
			function(data) {
				$('#attrSpace').html(data);
				initializeatt();
				AOS.refreshHard();
			});
	}


	$('#search-show').on('input',function(e){
		getShows();
	});

	$(window).load(function(){
		getShows();
		getAttractions();
		document.getElementsByTagName('body')[0].style.display = 'block';
		initializeatt();
		AOS.init();
		setInterval(initializeatt,100);
	})
</script>

</body>




</html>
