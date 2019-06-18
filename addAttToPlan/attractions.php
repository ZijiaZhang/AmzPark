<div class = "column">
	<?php 
	$Message = "";
	include_once '../database.php';


	$NoRepair = $_POST["today"];
	$ShortWait = $_POST["wait"];
	$Swait = $_POST["shortWait"];
	$Lwait = $_POST["longWait"];

	$Att = $_POST["attr"];
	$pname = $_POST["pname"];


      //  var_dump($_POST);
	?>

	<?php if(isset($_GET['Message'])){
		$Message = $_GET['Message'];
	}

	?>
	<p><?php echo $Message;?></p>




	
	<?php
	//var_dump($_POST);
	$query = "";
	if($Att!=""){
		$query = "and upper(A.ATT_NAME) LIKE upper('%$Att%')";
	}

	$WaitTime = "";
	if($ShortWait == "true"){
		$WaitTime = "and CAST(B.EXPECTED_WAITING_TIME AS INT) < 35 ";
	}

	$Repir = "";
	if($NoRepair == "true"){
		$Repir = "and A.STATUS = 'OPEN'";
	}

	$minTime ="";
	if($Swait == "true"){
		$minTime = "INTERSECT SELECT A.ATT_NAME,A.OPEN_TIME,A.CLOSE_TIME, B.EXPECTED_WAITING_TIME, A.STATUS FROM Attractions_Insepect_And_Determines_Status1 A, Attractions_Insepect_And_Determines_Status2 B WHERE A.capacity = B.capacity AND B.expected_Waiting_Time = (SELECT MIN(C.expected_Waiting_Time) FROM Attractions_Insepect_And_Determines_Status2 C)";
	}


	$maxTime = "";
	if($Lwait == "true"){
		$maxTime = "INTERSECT SELECT A.ATT_NAME,A.OPEN_TIME,A.CLOSE_TIME, B.EXPECTED_WAITING_TIME, A.STATUS FROM Attractions_Insepect_And_Determines_Status1 A, Attractions_Insepect_And_Determines_Status2 B WHERE A.capacity = B.capacity AND B.expected_Waiting_Time = (SELECT MAX(C.expected_Waiting_Time) FROM Attractions_Insepect_And_Determines_Status2 C)";
	}

	$stid = executeSQL("SELECT A.ATT_NAME,A.OPEN_TIME,A.CLOSE_TIME, B.EXPECTED_WAITING_TIME, A.STATUS FROM Attractions_Insepect_And_Determines_Status1 A, Attractions_Insepect_And_Determines_Status2 B WHERE A.capacity = B.capacity $query $Repir $WaitTime $minTime $maxTime");


	/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
	while ($row = OCI_Fetch_Array($stid, OCI_BOTH)) { ?>
		<div class = "image contianer attElem oneRow" data-aos="fade-up"
		data-aos-duration="500" data-aos-once="false" data-aos-offset="-50"> 

		<div class='attimage'>
			<a href = "../ATT/?attname=<?php echo $row["ATT_NAME"]?>" target = "_blank" >
				<img class= "attimg"src = "../server_files/images/<?php echo trim($row["ATT_NAME"]);?>.jpg" style="border-radius:16px;margin-left:0; width: 100%;float:left;">
			</a>

			<div style = "position: absolute; 
			bottom: 6px;
			right: 6px;
			background-color: rgba(255,255,255,0.5);
			color: white;
			padding-left: 10px;
			padding-right: 10px;
			border-radius:10px;
			font-size: 2vw;">
			<p style="color: #000;font-size: 50%"><?php echo trim( $row["ATT_NAME"]); ?></p>
		</div>
	</div>
	<style>
	input[name=addAtt]{
		background: #4d90fe;
		border-color: #3079ed;
		font-weight: bold;
		margin: 0 0 0 0;
		color: #fff;
		width: 80%;
		height: 100%;
		border-radius: 5px;
		padding: 8px 0px 8px 8px;
		/* font-size: 3%; */
		position: relative;
		margin-left: auto;
		margin-right: auto;
		display: block;
	}
</style>
<div class="table-wrap">
	<table class= "attinfo">
		<tr>
			<th class = "openTimehead"> Open Time </th>
			<th class = "closeTimehead"> Close Time </th>
			<th class = "waitTimehead"> Status </th>
			<th class = "actionhead tableisGood"> Action </th>
		</tr>
		<tr>
			<td class = "openTime"><?php echo trim( $row["OPEN_TIME"]); ?> </td>
			<td class = "closeTime"><?php echo trim( $row["CLOSE_TIME"]); ?> </td>
			<td class = "waitTime"><?php echo trim($row["STATUS"]); ?> </td>
			<td>
				<form action = "" method="post">
					<input type = "hidden" name = "planName" value = "<?php echo $pname; ?>" />
					<input type = "hidden" name = "attName" value = "<?php echo trim( $row["ATT_NAME"]); ?>" />
					<input type="submit" name = "addAtt" value = "Add it to this Plan" />
				</form>
			</td>
		</tr>
	</table>
</div>
</div>

<?php } ?>



</div>