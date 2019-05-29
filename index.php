<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<link rel="stylesheet" type = "text/css" href="./server_files/css/mycss.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body style="margin: 0px;" onload="initialize()" onresize="initialize()">
	<div class="slide-item" style="background-image:url(./server_files/images/park.jpg);background-repeat:no-repeat;background-position:left top;background-size:cover;height: 100%; position: fixed;float:all;width: 100%; opacity: 1;"></div>
	<div id = "nav-placeholder">
	
</div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
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

						<div class = "contianer attractions attlist">
							<div class = "column">
								<?php 
									include 'database.php';
									$stid = executeSQL('SELECT A.ATT_NAME,A.OPEN_TIME,A.CLOSE_TIME, B.EXPECTED_WAITING_TIME, A.STATUS FROM Attractions_Insepect_And_Determines_Status1 A, Attractions_Insepect_And_Determines_Status2 B WHERE A.capacity = B.capacity');
								


								/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
								while ($row = OCI_Fetch_Array($stid, OCI_BOTH)) { ?>
									<a class = "attlink listanimation listitem" href = "<?php echo $row["Link"]?>">
										<div class = "image contianer attElem row"> 

											<div class='attimage'>
												<img class= "attimg"src = "./server_files/images/<?php echo trim($row["ATT_NAME"]);?>.jpg" style="border-radius:16px;margin-left:0; width: 100%;float:left;" >

												<div style = "position: absolute; 
												bottom: 6px;
												right: 6px;
												background-color: rgba(255,255,255,0.5);
												color: white;
												padding-left: 10px;
												padding-right: 10px;
												border-radius:10px;">
												<p style="color: #000"><?php echo trim( $row["ATT_NAME"]); ?></p>
											</div>
										</div>
										<div class="table-wrap">
											<table class= "attinfo">
												<tr>
													<th class = "openTimehead"> Open Time </th>
													<th class = "closeTimehead"> Close Time </th>
													<th class = "waitTimehead"> Status </th>
												</tr>
												<tr>
													<td class = "openTime"><?php echo trim( $row["OPEN_TIME"]); ?> </td>
													<td class = "closeTime"><?php echo trim( $row["CLOSE_TIME"]); ?> </td>
													<td class = "waitTime"><?php echo trim($row["STATUS"]); ?> </td>
												</tr>
											</table>
										</div>
									</div>
								</a>

							<?php } ?>
							<?php

							oci_close($conn);

							?>
						</div>
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
				<a  href="https://github.com/ZijiaZhang99">
					<img src = "./server_files/icons/github-circle.png" >
				</a>
			</div>
		</div>
	</div>
</div>



<script>
	function filter(){
		var x = document.getElementById("search-attr");

		var all = document.getElementsByClassName("attlink");

		for(var t =0; t< all.length;t++){
			if(all[t].innerText.toUpperCase().includes(x.value.toUpperCase()))
				all[t].style.display = "";
			else
				all[t].style.display = "none";

		}


	}
	function initialize(){
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
				v.className = "waitTime tableisGood";
			}else{
				v.className = "waitTime tableisnotOk";
			}


		}

		document.addEventListener('keypress', keyfilter);
		function keyfilter(e){
			if(e.code == "Enter"){
				filter();
			}
		}
	}

</script>

</body>




</html>
