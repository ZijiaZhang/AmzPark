<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Add Attraction To Plan</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Muli:400,700|Overpass+Mono" rel="stylesheet">
</head>

<?php include "../loader.php";?>

<body style="margin: 0px" onload="initialize()" onresize="initializeatt()">


<div id = "nav-placeholder">
	
</div>
<script>
$(function(){
  $("#nav-placeholder").load("../navbar.html");
});
</script>

<div class= "nvbarSpliter"style="height: 100px"></div>



	<?php 
	include "../database.php";
	include "../session.php";
	$ispost =($_SERVER["REQUEST_METHOD"] == "POST");
//	var_dump($_POST);
	initializeSession();


	if(checkSession()){
//		var_dump(session_id());
		$gname = $_SESSION['login_user'];
	}else{
		header('location: ../login');
	}

	if($ispost) {
		//echo $gname;

	//	var_dump($_POST);

	// 	if (array_key_exists('createPlan', $_POST)){

	// 		$pname = $_POST['planName'];

	// 		if(ifExist($pname, 'PLANNUMBER' , 'PLAN')){
	// 			$Message = "This plan name is used in an existing plan. Either choose it from existing or use a new name";
	// 			header('location: ../makePlan_homepage/index.php?Message='.$Message);
	// 		} else{
	// 			try {
	// 				insertIntoPlan($pname);
	// 				insertIntoMadeBy($gname, $pname);
	// 				$Message = "Plan created successfully";
	// 			//	header('location: ./index.php?Message='.$Message);
	// 			}catch (Exception $e){
	// 				$Message = "Cannot Create Plan. Cannot insert into MadeBy table";
	// 			}
	// 		}

	// 	}
	// }

		if (array_key_exists('createPlan', $_POST)){

			$pname = $_POST['planName'];

			if(!ifExist($pname, 'PLANNUMBER' , 'PLAN')){
				try {
					insertIntoPlan($pname);
					insertIntoMadeBy($gname, $pname);
					$Message = "Plan created successfully";
				//	header('location: ./index.php?Message='.$Message);
				}catch (Exception $e){
					$Message = "Cannot Create Plan. Cannot insert into MadeBy table";
				}
			} else{
				$Message = "This plan name is used in an existing plan. Either choose it from existing or use a new name";
				header('location: ../makePlan_homepage/index.php?Message='.$Message);
			}

		}
	}

	if($ispost) {
		if(isset($_POST['planName']))
			$pname = $_POST['planName'];
		if(isset($_POST['attName']))
			$aname = $_POST['attName'];

		if (array_key_exists('addAtt', $_POST)){
			if(!ifExist2($pname, $aname, 'PLANNUMBER' , 'ATTNAME', 'ofVisiting')){
				try {
					insertIntoOfVisiting($pname,$aname);
					
				//header('location: ../addAttToPlan/index.php');
					$Message = "Attraction added successfully";
					
				}catch (Exception $e){
					$Message = "Error. Cannot add it to the plan.";
				}
			}
			else{
				$Message =  "This attraction is already in this plan";
			}


		}
	}


	?>
	<style>
	button{
		background-color: #00dcff;
		border-radius: 10px;
		color: white;
		font-size: 24px;
	}
	a{
		text-decoration: none;
	}

</style>


<section id = "attractions">
	<div class="component-wrapper " style="background-color: rgba(30,30,30,0.7)">
		<div style="height: 100px; width: 100%; padding: 0px;"></div>
		<div id = "attractions-background">
			<div class="att-outer">
				<input id = "planName" type = "hidden" value ="<?php echo $pname;?>" >

				<h1 style="text-align: center;"> Attractions </h1>

				<a href="../makePlan_customized"><button>Go Back To Previous Page</button> </a>
				<a href="../makePlan_homepage"><button>Go Back To Make Plan Homepage</button> </a>



				<?php if(isset($_GET['Message'])){
					$Message = $_GET['Message'];
				}

				?>
				<?php if(isset($Message)){?>
						<p style="text-align: center; color: #f99500;"><b><?php echo $Message;?></b></p>
						<?php
					}?>
				<p style="text-align: center;border-style: solid;border-color: black;">Current Att in plan:
				<?php
				try{
					$list1 = array(":bind1" => $pname);
					$r = executeBoundSQL("SELECT LISTAGG(ATTNAME, ', ') WITHIN GROUP (ORDER BY ATTNAME) FROM ofVisiting WHERE PLANNUMBER = :bind1 GROUP BY PLANNUMBER",$list1);
					echo oci_fetch_array($r)[0];
				}catch(Exception $e){
					
				}
				?>

				</p>

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
						<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;">
							<input id = "attrRP" type="checkbox" name = "noRPAttr">Exclude Repairing
						</div>
						<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;">
							<input id = "attrWait" type="checkbox" name = "ShortWait">Exclude Long Waiting Time
						</div>
						<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;">
							<input id = "min" type="checkbox" name = "minWait">See which one has minimum waiting time
						</div>
						<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;">
							<input id = "max" type="checkbox" name = "maxWait">See which one has maximum waiting time
						</div>
						<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;">
							<pre> Click on the image to see full information about this attraction</pre>
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

<script>
	function filter(){
		getAttractions();
		AOS.refresh();

	}



	function initialize(){
		getAttractions();
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


	$('#attrRP').change(function(){
		getAttractions();
	});



	$('#attrWait').change(function(){
		getAttractions();
	});

	$('#min').change(function(){
		getAttractions();
	});

	$('#max').change(function(){
		getAttractions();
	});

	

	$('#search-attr').on('input',function(e){
		getAttractions();
	});

	function getAttractions() {
		var today = $('input[name=noRPAttr]').is(':checked');
		var wait = $('input[name=ShortWait]').is(':checked');
		var shortWait = $('input[name=minWait]').is(':checked');
		var longWait = $('input[name=maxWait]').is(':checked');
		var query = $('#search-attr').val();
		var pname = $('#planName').val();
		$.post("../addAttToPlan/attractions.php", { today: today, wait: wait, shortWait: shortWait, longWait: longWait, attr: query, pname: pname},
			function(data) {
				$('#attrSpace').html(data);
				initializeatt();
				AOS.refreshHard();
			});
	}



	$(window).load(function(){

		document.getElementsByTagName('body')[0].style.display = 'block';
		initializeatt();
		AOS.init();
		setInterval(initializeatt,100);
	})
</script>

</body>




</html>
