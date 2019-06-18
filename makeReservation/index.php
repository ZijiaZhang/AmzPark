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


<style>

select {
	width: 100%;
	margin: 0;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	border-radius:5px;
	-webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
	-moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
	background: #f8f8f8;
	color:black;
	border: 1px solid black;
	outline:none;
	display: inline-block;
	-webkit-appearance:none;
	-moz-appearance:none;
	appearance:none;
	cursor:pointer;
	font-size: 24px;
	padding: 15px 0px 15px 8px;
	box-shadow: inset 4px 6px 10px -4px rgba(0, 0, 0, 0.3), 0 1px 1px -1px rgba(255, 255, 255, 0.3);
	background-color: white;

}

.selectWrap {
	position:relative;
	width:60%;
	padding: 0;
}


.selectWrap:after {
	content: '<>';
	font: 24px "Consolas";
	color: #aaa;
	-webkit-transform: rotate(90deg);
	-moz-transform: rotate(90deg);
	-ms-transform: rotate(90deg);
	transform: rotate(90deg);
	right: 8px;
	top: 13px;
	padding: 0 0 2px;
	border-bottom: 1px solid #ddd;
	position: absolute;
	pointer-events: none;

}
td{
	text-align: center;
}
</style>

<body style = "background-color:white">
	<div id = "nav-placeholder">

	</div>

	<p style="text-align:center;"> <font size = "6"> Entertainment Reservation System </font></p>

	<div style="margin-top:60px"></div>

	<?php
	$Message = "";
	include "../database.php";
	include "../session.php";
	$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

	initializeSession();
	if(checkSession()){
		$name = $_SESSION['login_user'];
	}else{
		header('location: ../login');
	}


	$conNo = (string) rand(10000000,99999999);
	if ($ispost){
		//echo "Your request has been submitted.";
		$enterName = $_POST['enterName'];
		$time = $_POST['time'];
		$group = $_POST['groupID'];
		if (array_key_exists('insertsubmit', $_POST)) {
			if (!ifExist($enterName,'name', 'ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1')) {
				$Message = '<div style="font-size:1.25em;color:red; text-align:center">Error: The seleted entertainment does not exit! </div>';
			}
			if (!ifExist($time,'perform_time', 'ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1')) {
				$Message = '<div style="font-size:1.25em;color:red; text-align:center">Error: The selected perform time does not exit! </div>';
			}
			if (!ifExist($group,'groupID', 'Groups')) {
				$Message = '<div style="font-size:1.25em;color:red; text-align:center">Error: Your group does not exit! </div>';
			}
			else{
				try {
					insertIntoReservation($conNo,$group,$enterName,$time);
					$Message = '<div style="font-size:1.25em;color:red; text-align:center">Reservation has been made successfully! </div>';
					// urlencode("Reservation has been made successfully");
					//header('location: ./?Message='.$Success);
				} catch (Exception $e) {
					$Message = '<div style="font-size:1.25em;color:red; text-align:center">Error: ERROR!!!! You have already signed up for this Show. </div>';
				}
			}
		}
		
	}

	if ($ispost) {
		if (array_key_exists('checksubmit', $_POST)) {
			$group_ID = $_POST['groupID'];
			$result = executeSQL("SELECT entertainmentName, perform_time FROM Reservation_linkedTo_ManagedBy
							 WHERE groupID = '$group_ID'");
			$columNames = array("Entertainment Name", "Reserved Time");
			echo "Here is the your reservations:";
			echo "<table>";
			echo "<tr>";
			foreach ($columNames as $oooname){
				echo "<th>$oooname</th>";
			}
			echo "</tr>";

			while ($row = OCI_Fetch_Array($result, OCI_BOTH)){
				echo "<tr><td>" . $row['ENTERTAINMENTNAME'] . "</td><td>" . $row['PERFORM_TIME'] . "</td></tr>";
			}

			echo "</table>";	
		}
	}
	?>


	<div style="text-align: center">
		<img src="live.jpg">
	</div>

	<?php echo $Message;?>
	<form action="" method = "POST">
		<div>
			<label class = "center">Entertainment</label>
			<div class = "selectWrap">
				<select style="font-size:16pt;" name="enterName"  required>
					<?php $r = executeSQL("SELECT DISTINCT name FROM ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1");
					while($row = oci_fetch_array($r)){
						?>
						<option value = "<?php echo $row['NAME'];?>"><?php echo $row['NAME'];?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>

		<div style=""></div>

		<div>
			<label  class = "center">Perform Time</label>
			<div class = "selectWrap">
				<select type="text" style="font-size:16pt;" name="time" placeholder="eg:20190701 14:00">

				</select>
			</div>
		</div>

		<div style="margin-top:20px"></div>

		<div>
			<label  class = "center">Your Group ID</label>
			<input type="hidden" name="groupID" value="<?php echo$name;?>" />
			<input type="text" style="font-size:16pt; background-color: rgba(100,100,100,0.5);" name="groupID" size="10" value = '<?php echo$name;?>'disabled>
		</div>

		<div style="margin-top:20px"></div>

		<div>
			<input type="submit" value="Make reservation" name="insertsubmit"></p>
		</div>

		<!-- <p>If you wish to check your reservation, enter your group ID and then press the check reservation button.</p>
 -->
		<!-- <div>
			<label  class = "center">Group ID</label>
			<input type="hidden" name="group_ID" value="<?php echo$name;?>" />
			<input type="text" style="font-size:16pt; background-color: rgba(100,100,100,0.5);" name="groupID" size="10" value = '<?php echo$name;?>'disabled>
		</div> -->
		
		<div>
		    <input type="submit" value="Check reservation" name="checksubmit"></p>
		</div>
	</form>


	<script>
		$(function(){
			$("#nav-placeholder").load("../navbar.html");
		});
		$('select[name=enterName]').change(function(){
			updateTime();
		});

		function updateTime() {
			var name = $('select[name=enterName]').val();
			$.post("./getPerformTime.php", { name: name},
				function(data) {
					$('select[name=time]').html(data);
				});
		}

		updateTime();
	</script>

</body>


</html>
