<?php

//include_once '../login.php';
$message = "";
include_once '../showutil.php';
include_once '../session.php';
include_once '../database.php';
initializeSession();
#print_r($_SESSION);

if(checkSession()){
		//header('location: ./account');
	//echo "Your Session ID: ";
	//var_dump(session_id());
	$name = $_SESSION['login_user'];
}else{
	header('location: ../login');
}

?>

<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/form.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Muli:400,700|Overpass+Mono" rel="stylesheet">
</head>
<?php include "../loader.php"; ?>
<body style="margin: 0px;">
	<div id = "nav-placeholder">
	
</div>
<script>
$(function(){
  $("#nav-placeholder").load("../navbar.html");
});
</script>

<div class= "nvbarSpliter"style="height: 100px"></div>
			<?php
			$count = executeSQL("SELECT count(*) FROM Reservation_linkedTo_ManagedBy WHERE groupID = '$name' Group by groupID");
			$c = oci_fetch_array($count);
			?> 
			<p style = 'text-align:center'>You have <?php echo $c[0]?> Reservations: </p>
			<?php

			$result = executeSQL("SELECT A.entertainmentName, A.perform_time, B.location, B.duration, B.price,B.category FROM Reservation_linkedTo_ManagedBy A, Entertainments_Determin_Status_And_Arrange_Times2 B
							 WHERE groupID = '$name' AND A.entertainmentName = B.name");
			$columNames = array("Entertainment Name", "Reserved Time", "Location","Duration","Price","Category");
			echo "<table class = 'halfWidth bd'>";
			echo "<tr>";
			foreach ($columNames as $oooname){
				echo "<th>$oooname</th>";
			}
			echo "</tr>";

			while ($row = OCI_Fetch_Array($result, OCI_BOTH)){
			?>	<tr>
				<td><?php echo $row['ENTERTAINMENTNAME'];?></td>
				<td><?php 

				$timeResult = handleTime($row["PERFORM_TIME"]);
							echo $numberToMonth[(int)$timeResult["month"]]." ".$timeResult["day"]." ".$timeResult["hourmin"]; ?> </td>
				<td><?php echo $row['LOCATION'];?> </td>
				<td><?php echo $row['DURATION'];?> </td>
				<td>$<?php echo $row['PRICE'];?> </td>
				<td><?php echo $row['CATEGORY'];?> </td>
		</tr>
			<?php
			}

			echo "</table>";

			?>
</body>


</html>
