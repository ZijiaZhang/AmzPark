<?php
//include_once '../login.php';
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

<?php
#var_dump($_POST);
if(isset($_POST['submit'])){
	if($_POST['submit']== 'delete_adult'){
		$Visitername = $_POST['del_visitor'];
		try{
			$list1 = array(":bind1" => $name, ":bind2" => $Visitername);
			executeBoundSQL("DELETE FROM AdultVisitor_include where groupID = :bind1 and visitorname = :bind2",$list1);
		}catch (Exception $e){

		}
	}else if($_POST['submit'] == 'insert_adult'){
		$Visitername = $_POST['ins_visitor'];
		$Contact = $_POST['ins_contact'];
		try{
			insertIntoAdults($Visitername,$name,$Contact);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	try{
		updateGroupSize($name);
	}catch(Exception $e){
		echo $e->getMessage();
	}

}

?>


<?php

//var_dump($_POST);

if(isset($_POST['submit'])){
	if($_POST['submit']== 'delete_plan'){
		$planname = $_POST['del_plan'];
		try{
			$list1 = array(":bind1" => $name, ":bind2" => $planname);
			executeBoundSQL("DELETE FROM madeBy where groupID = :bind1 and PLANNUMBER = :bind2",$list1);
		}catch (Exception $e){
			echo $e->getMessage();
		}
	}
}

?>







<?php


$groupSize = 'ERROR';
$Adults = 'ERROR';
$Children = 'ERROR';
try{
	$info = getMember($name);
#	var_dump($info);
	$groupSize = $info['GS'];
	$Adults = $info['AD'];
	$Children = $info ['CH'];
}catch(EXception $e){
	echo $e->getMessage();
}


#echo "Your Username is $name";


?>


<?php
try{
	$myplans = getPlan($name);
//	var_dump($myplan);
}catch(EXception $e){
	echo $e->getMessage();
}




?>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>My Account</title>
	<link rel="stylesheet" type="text/css" href="../server_files/css/myaccount.css">
	<link rel="stylesheet" type="text/css" href="../server_files/css/mycss.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<link rel="stylesheet" type="text/css" href="../server_files/css/plan.css">
</head>
<?php include "../loader.php" ?>
<body style="margin: 0px;">
	<style>

		#mainContainer{
			width: 100vw;
			height: 100vh;
			display: flex;
		}
		#operationPannel{
/*	background-color: blue;
*/	width: 70%;
overflow: auto;
display: block;
}
#accinfo{
	overflow: auto;
/*	background-color: green;
*/	width :30%;
position: relative;
display: block;
}
#accinfo p a{
	color: blue;
}
#adultInfo tr td, #adultInfo tr th{
	border-style: solid;
	border-width: 2px
}
#adultInfo{
	border-collapse: collapse;
}

.popup {
	display:none;
	position: absolute;
	z-index: 9;
	background-color: white;
	border-style: solid;
	border-color: red;
	width: 90%;
	left: 5%;
}
</style>

<div id = "nav-placeholder">

</div>
<script>
	$(function(){
		$("#nav-placeholder").load("../navbar.html");
	});
</script>
<div style="height: 100px"></div>
<div id = "mainContainer">
	
	<div id = "accinfo">
		<p>Your Group Name is <a><?php echo $name ?> </a></p>
		<p>Your Group Size is <a> <?php echo $groupSize;?> </a></p>
		<button id="adultPanelButton" onclick="ToggleForm()">Create Adult</button>
		<div class="popup" id="adultAddform">
			<form action="" class="form-container" method = "post">
				<h1>ADD ADULT</h1>
				<table>
					<tr>
						<td>
							<label for="name"><b>Name</b></label>
						</td>
						<td>
							<input type="text" placeholder="Enter Name" name="ins_visitor" required>
						</td>
					</tr>
					<tr>
						<td>

							<label for="contact"><b>Contact</b></label>
						</td>
						<td>
							<input type="text" placeholder="Enter Contact" name="ins_contact" required>
						</td>
					</tr>
				</table>
				<div class = "row">
					<button type="submit" class="" name = "submit" value = 'insert_adult'>Create</button>
					<button type="button" class="" onclick="closeForm()">Close</button>
				</div>
			</form>
		</div>


		<table id = "adultInfo" class = "fullWidth">
			<tr>
				<th width="30%">
					Name
				</th>
				<th width="40%">
					Contact
				</th>
				<th width="30%">
					delete
				</th>
			</tr>
			<?php foreach($Adults as $adult){ ?>
				<form action = "" method = "post">
					<tr>
						<td >
							<input type = "hidden" name = "del_visitor" value = <?php echo "'".$adult['VISITORNAME']."'";?> > <?php echo $adult['VISITORNAME'];?>
						</td>
						<td> 
							<?php echo $adult['CONTACT_INFO'];?>
						</td>
						<td>
							<button type="submit" value = "delete_adult" name = "submit">Delete</button>
						</td>
					</tr>
				</form>
			<?php } ?>

		</table>
		
	</div>

	<div id = "operationPannel">
		<h1 class="subTitle">Attractions</h1>
		<div class="row">
			<a href="../makePlan_homepage" class = "generalButton" style = "background-color: green"> Make Plans</a>
			<a href="../makePlan_mine" class = "generalButton" style = "background-color: blue">See My Plans</a>
		</div>
		<table id = "planInfo" class = "halfWidth">
			<tr><th>Plan</th><th>Delete</th></tr>
			<?php foreach($myplans as $plan){ ?>
				<form action = "" method = "post">
					<tr>
						<td>
							<input type = "hidden" name = "del_plan" value = <?php echo "'".$plan[0]."'";?> > <?php echo $plan[0];?>
						</td>
						<td>
							<button type="submit" value = "delete_plan" name = "submit">Delete</button>
						</td>
					</tr>
				</form>
			<?php } ?>
		</table>
		<pre> For further modifications, please click on "See My Plans" </pre>
	</div>

</div>

</div>
<a href="../logout.php">Log Out</a>
<script>
	function ToggleForm() {
		if(document.getElementById("adultAddform").style.display == "block"){
			document.getElementById("adultAddform").style.display = "none";
			document.getElementById("adultPanelButton").innerHTML = "Create Adult";
		}
		else{
			document.getElementById("adultAddform").style.display = "block";
			document.getElementById("adultPanelButton").innerHTML = "Close Window";
		}
	}

	function closeForm() {
		document.getElementById("adultAddform").style.display = "none";
	}
</script>
</body>
</html>

