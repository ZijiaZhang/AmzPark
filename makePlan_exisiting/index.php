<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/plan.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<?php
//include_once '../login.php';
include_once '../session.php';
include_once '../database.php';
initializeSession();
#print_r($_SESSION);

if(checkSession()){
		//header('location: ./account');
	$name = $_SESSION['login_user'];
}else{
	header('location: ../login');
}
?>
<body>
	<div id = "nav-placeholder">

	</div>
	<script>
		
		$(function(){
			$("#nav-placeholder").load("../navbar.html");
			$("#nav-placeholder").show();
		});
	</script>


	<section id = "Existing" >
		<div class="component-wrapper " style="background-color: rgba(30,30,30,0.7)">
			<div style="height: 100px; width: 100%; padding: 0px;"></div>
			<div id = "attractions-background">
				<div class="att-outer">


					<h1 style="text-align: center;"> Existing Plans </h6>

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

							// include '../database.php';

							// $ispost =($_SERVER["REQUEST_METHOD"] == "POST");

							// if($ispost) {
							// 	$groupID = $_POST['groupID'];
							// }


								$stid = executeSQL("SELECT PLANNUMBER, LISTAGG(ATTNAME, ',') WITHIN GROUP (ORDER BY ATTNAME) FROM ofVisiting GROUP BY PLANNUMBER");
								
								/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
								while ($row = OCI_Fetch_Array($stid, OCI_BOTH)) { ?>
									<div class = "listitem">
										<div class = "image contianer attElem row" data-aos="fade-up"
										data-aos-duration="500"> 

										<div class="table-wrap">
											<table class= "planinfo">
												<tr>
													<th class = ""> Plan Name </th>
													<th class = ""> Attractions in this plan </th>
													<th>Action</th>
												</tr>
												<tr>
													<td class = ""><?php echo trim( $row["PLANNUMBER"]); ?> </td>
													<td class = ""><?php echo trim( $row["LISTAGG(ATTNAME,',')WITHINGROUP(ORDERBYATTNAME)"]); ?> </td>
													<td>
														<form action = "../addPlanToMine.php" method="post">
															<input type = "hidden" name = "planName" value = "<?php echo trim( $row["PLANNUMBER"]); ?>" />
															<input type="submit" value = "Add this plan to Mine" />
														</form>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>


							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>






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
