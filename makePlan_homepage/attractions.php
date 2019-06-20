	<?php 
	include_once '../database.php';

	
	$NoRepair = $_POST["today"];
	$Att = $_POST["attr"];
	$Swait = $_POST["shortWait"];
	$Lwait = $_POST["longWait"];

	$query = "";
	if($Att!=""){
		$query = "and upper(A.ATT_NAME) LIKE upper('%$Att%')";
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


	try{
		$stid = executeSQL("SELECT A.ATT_NAME,A.OPEN_TIME,A.CLOSE_TIME, B.EXPECTED_WAITING_TIME, A.STATUS FROM Attractions_Insepect_And_Determines_Status1 A, Attractions_Insepect_And_Determines_Status2 B WHERE A.capacity = B.capacity $query $Repir $minTime $maxTime");
	}catch(Exception $e){
		echo $e->getMessage();
	}
//echo "string";
 

	/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
	while ($row = OCI_Fetch_Array($stid, OCI_BOTH)) { ?>
		<a class = "attlink listanimation listitem" href = "../ATT/?attname=<?php echo $row["ATT_NAME"]?>" target = "_blank">
			<div class = "image contianer attElem oneRow" data-aos="fade-up"
			data-aos-duration="500" data-aos-once="false" data-aos-offset="-50"> 

			<div class='attimage'>
				<img class= "attimg"src = "../server_files/images/<?php echo trim($row["ATT_NAME"]);?>.jpg" style="border-radius:16px;margin-left:0; width: 100%;float:left;" >

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
</div>