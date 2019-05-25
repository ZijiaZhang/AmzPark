<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body style="margin: 0px;">
	<div id = "nav-placeholder">

	</div>
	<script>
		$(function(){
			$("#nav-placeholder").load("../navbar.html");
		});
	</script>




</body>
<div style="height: 100px"></div>


<?php 
$ispost = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	#print_r($_POST);
	$ispost = true;
}

if(/*$_SERVER["REQUEST_METHOD"] == "POST"*/false) {
      // username and password sent from form 

	$conn = OCILogon ("***REMOVED***", '***REMOVED***', "***REMOVED***");
	if (!$conn) {
		echo "ERROR";
	}
	$stid = OCIParse($conn, 'INSERT INTO Attractions_InsepectAndDeterminesStatus');
	$myusername = $_POST['username'];
	$mypassword = $_POST['password']; 
	if (!$stid) {
		echo "<br>Cannot parse this command: ". "<br>";
		$e = OCI_Error($conn); 
           // For OCIParse errors, pass the connection handle.
		echo htmlentities($e['message']);
		$success = False;
	}

	$r = OCIExecute($stid, OCI_DEFAULT);
	if (!$r) {
		echo "<br>Cannot execute this command: " . $cmdstr . "<br>";
		$e = oci_error($statement); 
           // For OCIExecute errors, pass the statement handle.
		echo htmlentities($e['message']);
		$success = False;
	} else {
	}

}


?>



<h1>Register</h1>
<form action ="" method="post">
	<label>UserName :</label><input type = "text" name = "username" class = "box"/><br /><br />
	<label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
	<label>Adults : </label>  
	<button type = button id = "addAdult">Add Adult</button>
	<table class = "adultsTable">
		<?php
		if($ispost){
			foreach($_POST["adults"] as $add){
				echo "<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '$add'></td></tr>";
			}
		}else{
			echo "<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '$add'></td></tr>";
		}

		?>

	</table>
	<label>Children: </label>
	<button type = button id = "addChildren">Add Children</button>
	<table class = "childrenTable">
		<?php
		if($ispost){
			for ($i = 0; $i < count($_POST["children"]); $i++) {
				$chd = $_POST['children'][$i];
				$res = $_POST['responsible'][$i];
				echo " <tr><td><input type='text' 
				name='children[]' 
				placeholder = 'Name Of the Children' 
				value = '$chd'> </td> 
				<td> <input type='text' name = 'responsible[]' placeholder= 'Name of the Responsible Adult' value = '$res'></td></tr>";
			}
		}

		?>

	</table>


	
	<input type = "submit" value = " Submit "/><br />
</form>


<script>
// Global variables

var $deletething = $('.del_thing');

$('#addAdult').click(function(){
	$thing_table = $('.adultsTable');
  // if input is empty, it won't add an empty row
    // new thing is added to end of table
    // change to prepend to add to the beginning of table
    $thing_table.append("<tr><td><input type='text' name='adults[]' placeholder='Name of an adult'></td></tr>");

  // empties the input when sumbit is clicked

});

$('#addChildren').click(function(){
	$thing_table = $('.childrenTable');
  // if input is empty, it won't add an empty row
    // new thing is added to end of table
    // change to prepend to add to the beginning of table
    $thing_table.append("<tr><td><input type='text' name='children[]' placeholder = 'Name Of the Children' value = ''></td><td> <input type='text' name = 'responsible[]' placeholder= 'Name of the Responsible Adult' value = ''></td><tr>");

  // empties the input when sumbit is clicked

});
</script>
</html>
