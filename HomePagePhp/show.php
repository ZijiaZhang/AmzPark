
	<?php
	$numberToMonth  = array(1=> "Jan", 2=>"Feb",  3=>"Mar" ,4=>"Apr", 5=>"May" , 6=> "Jun", 7=>"Jul" ,8 => "Aug" , 9=>"Sep" , 10 => "Oct", 11=>"Nov" , 12 =>"Dec");
	include_once '../database.php';

	$today = "";
	if($_POST["today"] !='false'){
		$date = date('Ymd');
		$today = " and A.perform_time LIKE '%'||$date||'%'";
	}
	
	$query = "";
	if($_POST["show"] != ""){
		$name = $_POST["show"];
		$query = " and upper(A.name) LIKE upper('%$name%')";
		#echo $query;
	}

	#var_dump(date("Ymd"));

	?>	
		<div class = "column">
			<div class = "image contianer showElem row" data-aos="fade-up" style="margin-top: 1em; margin-bottom: 1em; " 
			data-aos-duration="500" data-aos-once="false"> 

			<div class="table-wrap">
				<table class= "showinfo">
					<tr>
						<th class = "showNamehead"> Show Name </th> 
						<th class = "openTimehead">Time </th>
						<th class = "closeTimehead"> Location </th>
						<th class = "waitTimehead"> Status </th>
					</tr>
					<?php 
					
					$stid = executeSQL("SELECT A.name,A.perform_time,A.status, B.location, B.duration, B.category FROM Entertainments_Determin_Status_And_Arrange_Times1 A, Entertainments_Determin_Status_And_Arrange_Times2 B WHERE A.name = B.name$today$query  ORDER BY A.perform_time");


					/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
					while ($row = OCI_Fetch_Array($stid, OCI_BOTH)) { ?>
						<tr class = "oneshow">
							<td class="showName"> <?php echo $row["NAME"]; ?></td>
							<td class = "PerformTime"><?php 
							$timeResult = handleTime($row["PERFORM_TIME"]);
							echo $numberToMonth[(int)$timeResult["month"]]." ".$timeResult["day"]; 

							?> </td>
							<td class = "Location"><?php echo trim( $row["LOCATION"]); ?> </td>
							<td class = "Status"><?php echo trim($row["STATUS"]); ?> </td>
						</tr>


					<?php } ?>
				</table>
			</div>
		</div>
	</div>

	<?php
function handleTime($time){
	$year = substr($time,0, 4);
	$month = substr($time,4, 2);
	$day = substr($time,6, 2);
	$hourmin = substr($time, 9, 5);
	return array("year"=> $year,
		"month" => $month,
		"day" => $day,
		"hourmin" => $hourmin);
}


?>