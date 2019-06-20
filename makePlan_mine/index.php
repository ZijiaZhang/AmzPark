<html lang="en"><head>
	<meta charset="UTF-8">
	<title> My Plans</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/plan.css">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/form.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<?php
//include_once '../login.php';
include '../session.php';
include '../database.php';
initializeSession();
#print_r($_SESSION);

if(checkSession()){
	$name = $_SESSION['login_user'];
}else{
	header('location: ../login');
}
?>
<body style="margin:0; backgroung-color:white;">
	<div id = "nav-placeholder">


	</div>
	<script>
		$(function(){
			$("#nav-placeholder").load("../navbar.html");
		});
	</script>

	<div class = "nvbarSpliter" style="height: 100px"></div>

	<style>

		#planInfo tr td, #planInfo tr th{
			border-style: solid;
			border-width: 2px
		}
		#planInfo{
			border-collapse: collapse;
		}

	</style>



<a href="../myaccount"><button>GO BACK To My Account</button> </a>
<div style="position: relative;margin-left: auto;margin-right: auto; width:fit-content;color:red"> Note: if you want to add or delete attraction to or from a plan. <br> You will need to provide a new name for the changed plan so that other people using the original plan won't be affected.
</div>



	<?php
//var_dump($_POST);
	if(isset($_POST['submit'])){
		if($_POST['submit']== 'delete_plan'){
			$planname = $_POST['del_plan'];
			try{
				executeSQL("DELETE FROM madeBy where groupID = '$name' and PLANNUMBER = '$planname'");
			}catch(Exception $e){
				echo "There is some error when deleting this plan";
			}
		}else if($_POST['submit'] == 'addToPlan'){
			$pname = $_POST['add_to_plan'];
			$pnameNew = $_POST['add_to_plan_new'];
			$aname = $_POST['addedAtt'];
			if (ifExist2($name, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')) {
				try{
					$Att = getAtt($pname);
				}catch(Exception $e){
					echo  "<b>"."Error when retriving all attractions in the original plan."."</b>";
				}

				if(ifExist($pnameNew, 'PLANNUMBER', 'plan')) {
					echo "<b>"."There is an existing plan with the same name as your new plan name. Please use a new plan name"."</b>";
					return;
				} else {
					try{
						insertIntoPlan($pnameNew);
					}catch(Exception $e){
						echo "<b>"."Error when creating new plan"."</b>";
					}
				}
				

				foreach($Att as $a){
					try{
						insertIntoOfVisiting($pnameNew,$a[0]);
					} catch(Exception $e){
						echo "Error when adding all attractions in original plan to new plan";
					}

				}

			// try{
			// 	executeSQL("DELETE FROM madeBy where groupID = '$name' and PLANNUMBER = '$pname'");
			// }catch(Exception $e){
		 //        echo "Error when removing the old plan from your plan list";
			// }
			// try{
			// 	insertIntoMadeBy($name, $pnameNew);		
			// }catch(Exception $e){
		 //       echo "Error when adding the new plan to your plan list";
			// }
				try{
				//executeSQL("UPDATE madeBy SET PLANNUMBER = '$pnameNew' WHERE groupID = '$name' AND PLANNUMBER = '$pname'");
					executeSQL("UPDATE madeBy set plannumber = '$pnameNew' where groupid='$name'and plannumber = '$pname'");
				} catch(Exception $e){
					echo "<b>"."Error when changing from original plan to new plan."."</b>";
				}

				if(ifExist2($pname, $aname, 'PLANNUMBER', 'ATTNAME', 'ofVisiting')){
					echo "<b>"."The attraction you entered is already in this plan. No change to your original plan."."</b>";
					executeSQL("UPDATE madeBy set plannumber = '$pname' where groupid='$name'and plannumber = '$pnameNew'");
					executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pnameNew'");
					executeSQL("DELETE FROM plan where PLANNUMBER = '$pnameNew'");
					return;
				}

				if(ifExist($aname,'att_name','ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1')){
					try{
						insertIntoOfVisiting($pnameNew, $aname);
					}catch(Exception $e){
						echo "Error when adding the new attraction";
					}
				}else{
					// executeSQL("DELETE FROM madeBy where groupID = '$name' and PLANNUMBER = '$pnameNew'");
					// insertIntoMadeBy($name, $pname);
					executeSQL("UPDATE madeBy set plannumber = '$pname' where groupid='$name'and plannumber = '$pnameNew'");
					executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pnameNew'");
					executeSQL("DELETE FROM plan where PLANNUMBER = '$pnameNew'");
					echo "<b>"."The attraction that you entered does not exist, so no change to your original plan. Please check your spelling."."</b>";
				}

			}else{
				echo "<b>"."You have not added this plan to your own plan list yet. Please only modify a plan in your own list."."</b>";
			}
		}
		else if($_POST['submit'] == 'delFromPlan'){
			$pname = $_POST['del_from_plan'];
			$pnameNew = $_POST['del_from_plan_new'];
			$aname = $_POST['delAtt'];
			if (ifExist2($name, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')) {
				try{
					$Att = getAtt($pname);
				}catch(Exception $e){
					echo "Error when retriving all attractions in the original plan.";
				}

				if(ifExist($pnameNew, 'PLANNUMBER', 'plan')) {
					echo "<b>"."There is an existing plan with the same name as your new plan name. Please use a new plan name"."</b>";
					return;
				} else {
					try{
						insertIntoPlan($pnameNew);
					}catch(Exception $e){
						echo "<b>"."Error when creating new plan"."</b>";
					}
				}
				

				foreach($Att as $a){
					try{
						insertIntoOfVisiting($pnameNew,$a[0]);
					} catch(Exception $e){
						echo "Error when adding all attractions in original plan to new plan";
					}

				}

				try{
					executeSQL("UPDATE madeBy set plannumber = '$pnameNew' where groupid='$name'and plannumber = '$pname'");
				} catch(Exception $e){
					echo "<b>"."Error when changing from original plan to new plan."."</b>";
				}
				if(!ifExist2($pname, $aname, 'PLANNUMBER', 'ATTNAME', 'ofVisiting')){
					echo "<b>"."The attraction you entered is NOT in this plan. No change to your original plan."."</b>";
					executeSQL("UPDATE madeBy set plannumber = '$pname' where groupid='$name'and plannumber = '$pnameNew'");
					executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pnameNew'");
					executeSQL("DELETE FROM plan where PLANNUMBER = '$pnameNew'");
					return;
				}

				if(ifExist($aname,'att_name','ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1')){
					try{
						executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pnameNew' and ATTNAME = '$aname'");
					}catch(Exception $e){
						echo "<b>"."Error when deleting the attraction"."</b>";
					}
				}else{
					// executeSQL("DELETE FROM madeBy where groupID = '$name' and PLANNUMBER = '$pnameNew'");
					// insertIntoMadeBy($name, $pname);
					executeSQL("UPDATE madeBy set plannumber = '$pname' where groupid='$name'and plannumber = '$pnameNew'");
					executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pnameNew'");
					executeSQL("DELETE FROM plan where PLANNUMBER = '$pnameNew'");
					echo "<b>"."The attraction you entered does not exist, so no change to your plan. Please check spelling. "."</b>";

				}
			}else{
				echo "<b>"."You have not added this plan to your own plan list yet. Please only modify a plan in your own list."."</b>";
			}

		}

		else if($_POST['submit'] == 'updatePlan'){
			$pname = $_POST['update_this_plan'];
			$pnameNew = $_POST['update_plan_new'];
			$aname = $_POST['update_this_Att'];
			$aname_new = $_POST['update_Att_new'];
			if (ifExist2($name, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')) {
				try{
					$Att = getAtt($pname);
				}catch(Exception $e){
					echo "Error when retriving all attractions in the original plan.";
				}

				if(ifExist($pnameNew, 'PLANNUMBER', 'plan')) {
					echo "<b>"."There is an existing plan with the same name as your new plan name. Please use a new plan name"."</b>";
					return;
				} else {
					try{
						insertIntoPlan($pnameNew);
					}catch(Exception $e){
						echo "<b>"."Error when creating new plan"."</b>";
					}
				}

				foreach($Att as $a){
					try{
						insertIntoOfVisiting($pnameNew,$a[0]);
					} catch(Exception $e){
						echo "Error when adding all attractions in original plan to new plan";
					}

				}


				try{
					executeSQL("UPDATE madeBy SET plannumber = '$pnameNew' where groupid='$name'and plannumber = '$pname'");
				} catch(Exception $e){
					echo "<b>"."Error when changing from original plan to new plan."."</b>";
				}


				if(!ifExist2($pname, $aname, 'PLANNUMBER', 'ATTNAME', 'ofVisiting')){
					echo "<b>"."The attraction you entered is NOT in this plan. No change to your original plan."."</b>";
					executeSQL("UPDATE madeBy set plannumber = '$pname' where groupid='$name'and plannumber = '$pnameNew'");
					executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pnameNew'");
					executeSQL("DELETE FROM plan where PLANNUMBER = '$pnameNew'");
					return;
				}


				if(ifExist($aname,'att_name','ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1') && ifExist($aname_new,'att_name','ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1') ){
					try{
						executeSQL("UPDATE ofVisiting SET ATTNAME = '$aname_new' where PLANNUMBER = '$pnameNew' and ATTNAME = '$aname'");
					}catch(Exception $e){
						echo "<b>"."Error when deleting the attraction"."</b>";
					}
				}else{
					// executeSQL("DELETE FROM madeBy where groupID = '$name' and PLANNUMBER = '$pnameNew'");
					// insertIntoMadeBy($name, $pname);
					executeSQL("UPDATE madeBy set plannumber = '$pname' where groupid='$name'and plannumber = '$pnameNew'");
					executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pnameNew");
					executeSQL("DELETE FROM plan where PLANNUMBER = '$pnameNew'");
					echo "<b>"."The attraction you entered does not exist, so no change to your plan. Please check spelling. "."</b>";

				}
				
			}else{
				echo "<b>"."You have not added this plan to your own plan list yet. Please only modify a plan in your own list."."</b>";
			}

		}
	}

	?>

<style>
#myPlans tr td, #myPlans tr th{
border-style: solid;
border-width: 2px;
border-color:black;
color:black;
}
#myPlans{
border-collapse: collapse;
}

.plButtons{
display:block;
}

@media screen and (max-width: 790px) {
    .plButtons{
    display: block;
    }
    .popup{
    width: 100%;
    }
    .center{
    display: flex;
    }
}

.popup{
    border-style: solid;
    border-color: #f99500;
}
</style>
	<div class = "plButtons" style="">
		<div id = "modify_add" >
			<button id="attPanelButton" onclick="ToggleForm()" >Add Attraction To A Plan</button>
			<div class="popup" id="AddAttform" style="display:none; position:static; background-color:white;z-index:9;">
				<form action="" class="form-container" method = "post">

					<h1>ADD Attraction</h1>
					<table>
						<tr>
							<td>
								<label for="pname"><b>Original Plan Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter Original Plan Name" name="add_to_plan" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="pnameNew"><b>New Plan Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter New Plan Name" name="add_to_plan_new" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="aname"><b>Attraction Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter Attraction Name" name="addedAtt" required>
							</td>
						</tr>
					</table>
					<div class ="row center" style = "width: auto;padding: 0 0 0 0;">
						<button type="submit" class="" name = "submit" value = 'addToPlan'>Add</button>
						<button type="button" class="" onclick="closeForm()">Close</button>
					</div>
				</form>
			</div>
		</div>

		<div id = "modify_delete">
			<button id="att2PanelButton" onclick="ToggleForm2()">Delete Attraction From A Plan</button>
			<div class="popup" id="DeleteAttform" style="display:none; position:static; background-color:white;z-index:9;">
				<form action="" class="form-container" method = "post">
					<h1>Delete Attraction</h1>
					<table>
						<tr>
							<td>
								<label for="pname"><b>Original Plan Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter Plan Name" name="del_from_plan" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="pnameNew"><b>New Plan Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter New Plan Name" name="del_from_plan_new" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="anamet"><b>Attraction Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter Attraction Name" name="delAtt" required>
							</td>
						</tr>
					</table>
					<div class ="row center" style = "width: auto;padding: 0 0 0 0;">
						<button type="submit" class="" name = "submit" value = 'delFromPlan'>Delete</button>
						<button type="button" class="" onclick="closeForm2()">Close</button>
					</div>
				</form>
			</div>
		</div>

		<div id = "modify_update">
			<button id="att3PanelButton" onclick="ToggleForm3()">Update an Attraction In A Plan</button>
			<div class="popup" id="UpdateAttform" style="display:none; position:static; background-color:white;z-index:9;">
				<form action="" class="form-container" method = "post">
					<h1>Update Attraction</h1>
					<table>
						<tr>
							<td>
								<label for="pname"><b>Original Plan Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter Plan Name" name="update_this_plan" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="pnameNew"><b>New Plan Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter New Plan Name" name="update_plan_new" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="anamet"><b>Original Attraction Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter Attraction Name" name="update_this_Att" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="anamet_new"><b>New Attraction Name</b></label>
							</td>
							<td>
								<input type="text" placeholder="Enter New Attraction Name" name="update_Att_new" required>
							</td>
						</tr>
					</table>
					<div class ="row center" style = "width: auto;padding: 0 0 0 0;">
						<button type="submit" class="" name = "submit" value = 'updatePlan'>Update</button>
						<button type="button" class="" onclick="closeForm3()">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>





	<section id = "Mine" >
	<!-- <div class="simple-chord--wrapper component-wrapper" style="background-color: rgba(100,100,100,0.3);">
		<head>
			<title>My Plans</title>
		</head>
		<body>
			<table id = "myPlans">
					<tr>
						<th>Plan Name</th>
						<th>Attractions in this plan</th>
						<th>Action</th>
					</tr>
				</thead> -->
				<h1 class="fullWidth"> My Plans </h1>
				<?php
			$count = executeSQL("SELECT count(*) FROM madeBy WHERE groupID = '$name' Group by groupID");
			$c = oci_fetch_array($count);
			?> 
			<p style = 'text-align:center'>You have <?php echo $c[0]?> Plans: </p>
				<table id = "planInfo" class = "fullWidth">
					<tr>
						<th width="30%">
							Plan Name
						</th>
						<th width="50%">
							Attractions in this plan
						</th>
						<th width="20%">
							delete
						</th>
					</tr>
					<?php
					try{
						$results = executeSQL("SELECT B.PLANNUMBER, LISTAGG(B.ATTNAME, ',') WITHIN GROUP (ORDER BY B.ATTNAME) FROM ofVisiting B, madeby A WHERE A.PLANNUMBER = B.PLANNUMBER AND A.groupID='$name' GROUP BY B.PLANNUMBER" );
					}catch ( Exception $e){
						echo $e->getMessage();
					}
         //   echo "OK";
					while($row =  OCI_Fetch_Array($results)) {
						?>
						<form action = "" method = "post">
							<tr>
								<td><input type = "hidden" name = "del_plan" value = <?php echo "'".$row['PLANNUMBER']."'";?> > <?php echo $row['PLANNUMBER'];?></td>
								<td><?php echo $row[1];?></td>
								<td><button type="submit" value = "delete_plan" name = "submit">Delete</button></td>
							</tr>
						</form>

						<?php
					}
					?>
					<?php
					try{
						$results = executeSQL("SELECT PLANNUMBER FROM madeBy WHERE GROUPID = '$name' MINUS SELECT B.PLANNUMBER FROM ofVisiting B, madeby A WHERE A.PLANNUMBER = B.PLANNUMBER AND A.groupID='$name' GROUP BY B.PLANNUMBER" );
					}catch ( Exception $e){
						echo $e->getMessage();
					}
         //   echo "OK";
					while($row =  OCI_Fetch_Array($results)) {
						?>
						<form action = "" method = "post">
							<tr>
								<td><input type = "hidden" name = "del_plan" value = <?php echo "'".$row['PLANNUMBER']."'";?> > <?php echo $row['PLANNUMBER'];?></td>
								<td><?php echo $row[1];?></td>
								<td><button type="submit" value = "delete_plan" name = "submit">Delete</button></td>
							</tr>
						</form>

						<?php
					}
					?>
				</table>
	<!-- 	</body>
	</div> -->

</section>




<script>
	function ToggleForm() {
		if(document.getElementById("AddAttform").style.display == "block"){
			document.getElementById("AddAttform").style.display = "none";
			document.getElementById("attPanelButton").InnerHTML = "Add attraction to a Plan";
		}
		else{
			document.getElementById("AddAttform").style.display = "block";
			document.getElementById("attPanelButton").InnerHTML = "Close Window";
		}
	}

	function ToggleForm2() {
		if(document.getElementById("DeleteAttform").style.display == "block"){
			document.getElementById("DeleteAttform").style.display = "none";
			document.getElementById("att2PanelButton").InnerHTML = "Delete attraction from a plan";
		}
		else{
			document.getElementById("DeleteAttform").style.display = "block";
			document.getElementById("att2PanelButton").InnerHTML = "Close Window";
		}
	}

	function ToggleForm3() {
		if(document.getElementById("UpdateAttform").style.display == "block"){
			document.getElementById("UpdateAttform").style.display = "none";
			document.getElementById("att3PanelButton").InnerHTML = "Update an attraction in a plan";
		}
		else{
			document.getElementById("UpdateAttform").style.display = "block";
			document.getElementById("att3PanelButton").InnerHTML = "Close Window";
		}
	}




	function closeForm() {
		document.getElementById("AddAttform").style.display = "none";
	}

	function closeForm2() {
		document.getElementById("DeleteAttform").style.display = "none";
	}

	function closeForm3() {
		document.getElementById("UpdateAttform").style.display = "none";
	}


</script>

</body>

</body>
</html>
