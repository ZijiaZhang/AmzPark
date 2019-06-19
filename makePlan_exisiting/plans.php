<div class = "column">

	<?php
//include_once '../login.php';
	include_once '../session.php';
	include_once '../database.php';
	initializeSession();
//print_r($_SESSION);

	if(checkSession()){
		//header('location: ./account');
		$name = $_SESSION['login_user'];
	}else{
		header('location: ../login');
	}
	?>
	
	<?php 
	include_once '../database.php';

	$NotAdd = $_POST["added"];
	$div = $_POST["all"];
	$pl = $_POST["plan"];


//	echo "$pname";

	//var_dump($_POST);
	// $query = "";
	// if($pl!=""){
	// 	$query = "WHERE upper(PLANNUMBER) LIKE upper('%$pl%')";
	// }

	$query = "";
	if($pl!=""){
		if($div == "true"){
			$query = "AND upper(b.PLANNUMBER) LIKE upper('%$pl%')";
		} else{
			$query = "WHERE upper(PLANNUMBER) LIKE upper('%$pl%')";
		}
	}


	$add = "";
	if($NotAdd == "true"){
		$add = "MINUS SELECT B.PLANNUMBER, LISTAGG(B.ATTNAME, ', ') WITHIN GROUP (ORDER BY B.ATTNAME) FROM ofVisiting B, madeby A WHERE A.PLANNUMBER = B.PLANNUMBER AND A.groupID='$name' GROUP BY B.PLANNUMBER";
	}

	if($div == "true"){
		// executeSQL("CREATE view openAtt as SELECT * from ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1 a where a.status='OPEN'");
		// executeSQL("CREATE view goodPlan as SELECT * from plan a where NOT EXISTS (select * from openAtt b where NOT EXISTS (select * from ofvisiting c where a.plannumber = c.plannumber and b.att_name = c.attname))");
		$stid = executeSQL("SELECT b.PLANNUMBER, LISTAGG(b.ATTNAME, ', ') WITHIN GROUP (ORDER BY b.ATTNAME) FROM goodPlan a, ofVisiting b WHERE a.plannumber = b.plannumber $query GROUP BY b.PLANNUMBER $add");
	}else{
		$stid = executeSQL("SELECT PLANNUMBER, LISTAGG(ATTNAME, ', ') WITHIN GROUP (ORDER BY ATTNAME) FROM ofVisiting $query GROUP BY PLANNUMBER $add");
	}
	// $stid = executeSQL("SELECT PLANNUMBER, LISTAGG(ATTNAME, ', ') WITHIN GROUP (ORDER BY ATTNAME) FROM ofVisiting $query GROUP BY PLANNUMBER $add");


	/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
	while ($row = OCI_Fetch_Array($stid, OCI_BOTH)) { ?>
		<div class = "listitem">
			<div class = "image contianer attElem oneRow" data-aos="fade-up"
			data-aos-duration="500"> 

			<div class="table-wrap">
				<table class= "planinfo">
					<tr>
						<th width = "30%" class = ""> Plan Name </th>
						<th width = "40%" class = ""> Attractions in this plan </th>
						<th width = "30%">Action</th>
					</tr>
					<tr>
						<td class = ""><?php echo trim( $row["PLANNUMBER"]); ?></td>
						<td class = ""><?php echo trim( $row[1]); ?> </td>
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