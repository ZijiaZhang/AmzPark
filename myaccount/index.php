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
var_dump($_POST);
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


$groupSize = 'ERROR';
$Adults = 'ERROR';
$Children = 'ERROR';
try{
	$info = getMember($name);
	var_dump($info);
	$groupSize = $info['GS'];
	$Adults = $info['AD'];
	$Children = $info ['CH'];
}catch(EXception $e){
	echo $e->getMessage();
}


echo "Your Username is $name";


?>


<style>
#mainContainer{
	width: 100%;
	height: 100%;
	display: flex;
}
#operationPannel{
	background-color: blue;
	width: 70%;
	overflow: auto;
	display: block;
}
#info{
	overflow: auto;
	background-color: green;
	width :30%;
	position: relative;
	display: block;
}
#info p a{
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
	position: fixed;
	z-index: 9;
	background-color: white;
}
</style>


<div id = "mainContainer">
	<div id = "info">
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
					<button type="submit" class="" name = "submit" value = 'insert_adult'>Create</button>
					<button type="button" class="" onclick="closeForm()">Close</button>
				</form>
			</div>
			

			<table id = "adultInfo">
				<tr><th>Name</th><th>Contact</th><th>delete</th></tr>
				<?php foreach($Adults as $adult){ ?>
					<form action = "" method = "post">
						<tr><td><input type = "hidden" name = "del_visitor" value = <?php echo $adult['VISITORNAME'];?> > <?php echo $adult['VISITORNAME'];?></td>
							<td> <?php echo $adult['CONTACT_INFO'];?></td>
							<td><button type="submit" value = "delete_adult" name = "submit">Delete</button>
							</tr>
						</form>
					<?php } ?>

				</table>
				<button type="submit" class="" name = "submit" value = 'insert_adult'>Create</button>
				<button type="button" class="" onclick="closeForm()">Close</button>
			</form>
		</div>

			<div id = "operationPannel">
				<div class="dropdown">
                <button class="dropbtn">Attractions</button>
                <div class="dropdown-content">

                  <!-- <form action = "../makePlan_exisiting" method="post"> -->
				  <!-- <input type = "hidden" name = "groupID" value = "<?php echo $name;?>" /> -->
                  <a href="../makePlan_homepage">Make Plans about my tour</a>
                  <!-- </form> -->



                  <!-- <form action = "...??????????????" method="post"> -->
				  <!-- <input type = "hidden" name = "groupID" value = "$name" /> -->
                  <a href="../makePlan_mine">See My Plans</a>
                  <!-- </form> -->



                </div>
                </div>

                <!-- <div class="dropdown">
                <button class="dropbtn">Entertainments</button>
                <div class="dropdown-content">

                  <form action = "..??????/" method="post">
				  <input type = "hidden" name = "groupID" value = "$name" />
                  <a href="../">Make Reservations</a>
                  </form>

                  <form action = "...??????????????" method="post">
				  <input type = "hidden" name = "groupID" value = "$name" />
                  <a href="../">See My Reservations</a>
                  </form>

                </div>
                </div> -->
			</div>

		</div>
		<div id = "operationPannel">
			<p>Hello</p>
		</div>
	</div>
	<a href="../logout.php">Log Out</a>

	<script>
		function ToggleForm() {
			if(document.getElementById("adultAddform").style.display == "block"){
				document.getElementById("adultAddform").style.display = "none";
				document.getElementById("adultPanelButton").InnerHTML = "Create Adult";
			}
			else{
				document.getElementById("adultAddform").style.display = "block";
				document.getElementById("adultPanelButton").InnerHTML = "Close Window";
			}
		}

		function closeForm() {
			document.getElementById("adultAddform").style.display = "none";
		}
	</script>