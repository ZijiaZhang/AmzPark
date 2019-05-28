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
	include '../signup.php';

?>



<h1>Register</h1>
<form action ="" method="post">
	<label>UserName :</label><input type = "text" name = "username" class = "box" value = <?php echo $name;?> ><br /><br />
	<label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
	<label>Adults : </label>  
	<button type = button id = "addAdult">Add Adult</button>
	<table class = "adultsTable">
		<?php
		if($ispost){
			for($i=0; $i<count($_POST["adults"]);$i++){
				$add = $_POST["adults"][$i];
				$contect = $_POST["contact"][$i];
				if(trim($add)!='' || trim($contect)!='')
					echo "<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '$add'></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = '$contect'></td></tr>";
			}
		}else{
			echo "<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '$add'></td>
			<td><input type='text' name='contact[]' placeholder='Contect Info' value = '$contect'></td></tr>";
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
				if($chd!='')
					echo " <tr><td><input type='text' 
				name='children[]' 
				placeholder = 'Name Of the Children' 
				value = '$chd'> </td> 
				<td> <input type='text' name = 'responsible[]' placeholder= 'Name of the Responsible Adult' value = '$res'></td></tr>";
			}
		}

		?>

	</table>


	
	<input type = "submit" value = " Submit " name="submit" /><br />
</form>


<script>
// Global variables

var $deletething = $('.del_thing');

$('#addAdult').click(function(){
	$thing_table = $('.adultsTable');
  // if input is empty, it won't add an empty row
    // new thing is added to end of table
    // change to prepend to add to the beginning of table
    $thing_table.append("<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = ''></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = ''></td></tr>");

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
