<html lang="en"><head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/plan.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="../server_files/js/jquery.fittext.js"></script>
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
<style>
button{
    background-color: #00dcff;
    border-radius: 10px;
    color: white;
    font-size: 24px;
}
</style>
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
					<a href="../makePlan_homepage"><button>Go Back to Make Plan Home Page</button> </a>
					<?php if(isset($_GET['Message'])){?>
						<p><b>
							<?php	echo $_GET['Message'];?>
						</b></p>
						<?php
					}?>
				

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
							<div style="width: 100%">
								<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;">
									<input id = "planAdded" type="checkbox" name = "alreadyIn">Exclude those already added in Mine
								</div>
								<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;">
									<pre> <b> Note: Empty plans (plans with no attractions in it) will not appear here </b></pre>
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
				getPlans();
			}



			function initialize(){
				getPlans();
			}

			function initializeatt(){
		// 		var x = document.getElementsByClassName("attelem");
		// 		for(var t = 0; t< x.length;t++){
		// 			var p = x[t].getElementsByTagName("tr");
		// 			for(var i = 0 ; i<p.length ; i++ ){
		// 				var m = x[t].clientheight;
		// 				p[i].style.height = x[t].getElementsByClassName("attimg")[0].clientHeight/2 +"px";
		// 			}	

		// }
	}


	$('#planAdded').change(function(){
		getPlans();
	});



	$('#search-attr').on('input',function(e){
		getPlans();
	});


	function getPlans() {
		var added = $('input[name=alreadyIn]').is(':checked');
		var query = $('#search-attr').val();
		$.post("../makePlan_exisiting/plans.php", { added: added, plan: query},
			function(data) {
				$('#attrSpace').html(data);
				initializeatt();
			});
	}



	$(window).load(function(){
		initialize();
		document.getElementsByTagName('body')[0].style.display = 'block';
		initializeatt();
		setInterval(initializeatt,100);
	})
</script>

</body>




</html>
