<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<?php include "../loader.php";?>

<body style="margin: 0px" onload="initialize()" onresize="initializeatt()">


	<?php if(isset($_GET['Message'])){?>
		<p>
			<?php	echo $_GET['Message'];?>
		</p>
		<?php
	}?>

	<?php if(isset($_GET['Success'])){?>
		<p>
			<?php	echo $_GET['Success'];?>
		</p>
		<?php
	}?>


	<?php 
	include "../database.php";
	include "../session.php";
	$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

	initializeSession();


	if(checkSession()){
		var_dump(session_id());
		$gname = $_SESSION['login_user'];
	}else{
		header('location: ../login');
	}

	if($ispost) {

		var_dump($_POST);

		if (array_key_exists('createPlan', $_POST)){

			$pname = $_POST['planName'];

			if(!ifExist("'".$pname."'", 'PLANNUMBER' , 'PLAN')){
				try {
					insertIntoPlan($pname);
				}catch (Exception $e){
					echo $e->getMessage();
					echo "Cannot Create Plan. Cannot insert into Plan table";
				}
			}
			else{
				echo "Cannot Create Plan. Because the Plan name has been used. Please use a new plan name";
				$Error = urlencode("This plan name is used in an existing plan. Either choose it from existing or use a new name");
				header('location: ../makePlan_homepage/index.php?Message='.$Error);
			}


			if(!ifExist2($gname, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')){
				try {
					insertIntoMadeBy($gname, $pname);
					$Message = urlencode("Plan created successfully");
					header('location: ./index.php?Message='.$Message);
				}catch (Exception $e){
					echo "Cannot Create Plan. Cannot insert into MadeBy table";
				}
			}
			else{
				echo "There is already a plan with the same name in your plans. Please use a new name.";
				$Error = urlencode("There is already a plan with the same name in your plans. Please use a new name.");
				header('location: ../makePlan_customized/index.php?Message='.$Error);
			}

		}
	}

	?>


	<section id = "attractions">
		<div class="component-wrapper " style="background-color: rgba(30,30,30,0.7)">
			<div style="height: 100px; width: 100%; padding: 0px;"></div>
			<div id = "attractions-background">
				<div class="att-outer">
					<input id = "planName" type = "hidden" value ="<?php echo $pname;?>" >

					<h1 style="text-align: center;"> Attractions </h1>

					<a href="../makePlan_customized"><button>GO BACK To Previous Page</button> </a>
					<a href="../makePlan_homepage"><button>GO BACK To make plan homepage</button> </a>
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

	

	$('#search-attr').on('input',function(e){
		getAttractions();
	});

	function getAttractions() {
		var today = $('input[name=noRPAttr]').is(':checked');
		var wait = $('input[name=ShortWait]').is(':checked');
		var query = $('#search-attr').val();
		var pname = $('#planName').val();
		$.post("../addAttToPlan/attractions.php", { today: today, wait: wait, attr: query, pname: pname},
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
