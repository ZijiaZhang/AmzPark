<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	

	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" href="../server_files/css/form.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<?php include "../loader.php" ;
	include_once ('../session.php');
	initializeSession();
	if(checkSession()){
		header("location: ../myaccount");
	}

?>

<body style="margin: 0px;">
	<div id = "nav-placeholder">

	</div>
	<script>
		$(function(){
			$("#nav-placeholder").load("../navbar.html");
		});
	</script>

	<style>

</style>


</body>
<div style="height: 100px"></div>


<?php
include '../signup.php';

?>


<div class = "formContainer">
	<h1>Register</h1>

	<form action ="" method="post">
		<input  type = "text" name = "username" class = "box name" placeholder="Name" value = "<?php echo $name;?>" required>
		<p class = "name-help"> Name should have 8 or less characters.</p>
		<input type = "password" name = "password" class = "box pass" placeholder = "Password" required>
		<p class = "pass-help"> Please make sure your password is secure.</p>
		<hr>
		<div class = "oneRow">
			<label>Adults : </label>  
		<button type = button id = "addAdult">ADD ADULT</button>
		</div>
		<table class = "adultsTable mytable">
			<?php
			if($ispost){
				for($i=0; $i<count($_POST["adults"]);$i++){
					$add = $_POST["adults"][$i];
					$contect = $_POST["contact"][$i];
					if(trim($add)!='' || trim($contect)!='')
						echo "<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '$add' required></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = '$contect' required></td><td> <button type = button class = 'delete'>DELETE</button></td></tr>";
				}
			}else{
				echo "<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '' required></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = '' required></td><td> <button type = button class = 'delete'>DELETE</button></td></tr>";
			}

			?>

		</table>
		<hr>
		<div class="oneRow">
		<label>Children: </label>
		<button type = button id = "addChildren">ADD CHILDREN</button>
		</div>
		<table class = "childrenTable mytable">
			<?php
			if($ispost){
				for ($i = 0; $i < count($_POST["children"]); $i++) {
					$chd = $_POST['children'][$i];
					$res = $_POST['responsible'][$i];
					if($chd!='')
						echo " <tr><td><input type='text' 
					name='children[]' placeholder = 'Name Of the Children' value = '$chd' required> </td><td> <input type='text' name = 'responsible[]' placeholder= 'Responsible Adult' value = '$res' required></td><td> <button type = button class = 'delete'>DELETE</button></td></tr>";
				}
			}

			?>

		</table>

		<input type = "submit" value = " Submit " name="submit" autofocus /><br />
	</form>
</div>

<script>
// Global variables

var $deletething = $('.del_thing');

$('#addAdult').click(function(){
	$thing_table = $('.adultsTable');
  // if input is empty, it won't add an empty row
    // new thing is added to end of table
    // change to prepend to add to the beginning of table
    $thing_table.append("<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '' required></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = '' required></td><td> <button type = button class = 'delete'>DELETE</button></td></tr>");

  // empties the input when sumbit is clicked

});

$('#addChildren').click(function(){
	$thing_table = $('.childrenTable');
  // if input is empty, it won't add an empty row
    // new thing is added to end of table
    // change to prepend to add to the beginning of table
    $thing_table.append("<tr><td><input type='text' name='children[]' placeholder = 'Name Of the Children' value = '' required></td><td> <input type='text' name = 'responsible[]' placeholder= 'Responsible Adult' value = '' required></td><td> <button type = button class = 'delete'>DELETE</button></td><tr>");

  // empties the input when sumbit is clicked

});

$(".name").focus(function(){
  $(".name-help").slideDown(500);
}).blur(function(){
  $(".name-help").slideUp(500);
});

$(".pass").focus(function(){
  $(".pass-help").slideDown(500);
}).blur(function(){
  $(".pass-help").slideUp(500);
});


$('.mytable').on('click', '.delete', function(){
    var row = this.parentElement.parentElement;
  row.parentElement.removeChild(row);
});




</script>

</html>
