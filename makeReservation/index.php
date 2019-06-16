<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title> Amz Park</title>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" href="../server_files/css/form.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>



<body>
	<div id = "nav-placeholder">

	</div>

<p style="text-align:center;"> <font size = "6"> Entertainment Reservation System </font></p>

<div style="margin-top:60px"></div>

<div style="text-align: center">
  <img src="live.jpg">
</div>

<form action="makeReservation.php" method = "POST">
  <p> <font size = "5">
	<div style="margin-top:150px"></div>
	
	<div>
	   <label class = "center">Entertainment</label>
	   <input type="text" style="font-size:16pt;" name="enterName" size="15">
	</div>

	<div style="margin-top:20px"></div>

	<div>
     <label  class = "center">Perform Time</label>
     <input type="text" style="font-size:16pt;" name="time" placeholder="eg:20190701 14:00"size="15">
	</div>

	<div style="margin-top:20px"></div>

	<div>
	   <label  class = "center">Group ID</label>
		 <input type="text" style="font-size:16pt;" name="groupID" size="10">
	</div>

	<div style="margin-top:20px"></div>

	<div>
	 <input type="submit" value="Make reservation" name="insertsubmit"></p>
	</div>
</form>


<div style="margin-top:150px"></div>


<?php
include "../database.php";
include "../session.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

initializeSession();



$conNo = (string) rand(10000000,99999999);
if ($ispost){
	echo "Your request has been submitted.";
	$enterName = $_POST['enterName'];
	$time = $_POST['time'];
	$group = $_POST['groupID'];
	if (array_key_exists('insertsubmit', $_POST)) {
		if (!ifExist($enterName,'name', 'ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1')) {
		echo '<div style="font-size:1.25em;color:red">Error: The seleted entertainment does not exit! </div>';
	}
	 if (!ifExist($time,'perform_time', 'ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1')) {
		echo '<div style="font-size:1.25em;color:red">Error: The selected perform time does not exit! </div>';
	}
	 if (!ifExist($group,'groupID', 'Groups')) {
		echo '<div style="font-size:1.25em;color:red">Error: Your group does not exit! </div>';
	}
		else{
			try {
			insertIntoReservation($conNo,$group,$enterName,$time);
			echo '<div style="font-size:1.25em;color:red">Error: Reservation has been made successfully! </div>';
			$Success = urlencode("Reservation has been made successfully");
			header('location: makeReservation.php?Message='.$Success);
		} catch (Exception $e) {
				echo '<div style="font-size:1.25em;color:red">Error: ERROR!!!! </div>';
			}
		}
		}
		
	}
?>


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

<script>
$(function(){
  $("#nav-placeholder").load("../navbar.html");
});
</script>

</body>


</html>
