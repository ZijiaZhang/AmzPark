<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	

	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" href="../server_files/css/form.css">
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

	<style>

</style>


</body>
<div style="height: 100px"></div>




<div class = "formContainer">
	<h1>Confirm Info</h1>

	<form action ="" method="post">
		<input  type = "text" name = "GroupSize" class = "box name" placeholder="Group Size" value = "" required>
		<p class = "name-help"> Enter number of members in your Group.</p>
		<input type = "hidden" name = "accountName" value = <?php echo $_POST["accountName"] ?>>
		<hr>
		<table class = "adultsTable mytable">
			<tr><td><input id = "adultnm" type='text' name='adultnm' placeholder='Name of an adult' value = '' required></td><td><input id = "adultcontact" type='text' name='contact' placeholder='Contect Info' value = '' required></td><td></td></tr>

		</table>
		<p class = "pass-help"> Enter The Name And Contact Info of one of your adult number.</p>
		<button dis = "normal" type = "submit" value = "Infos" name="submit"> Submit </button><br />
	</form>
</div>

<script>
// Global variables


$(".name").focus(function(){
  $(".name-help").slideDown(500);
}).blur(function(){
  $(".name-help").slideUp(500);
});

$("#adultnm").focus(function(){
  $(".pass-help").slideDown(500);
}).blur(function(){
  $(".pass-help").slideUp(500);
});

$("#adultcontact").focus(function(){
  $(".pass-help").slideDown(500);
}).blur(function(){
  $(".pass-help").slideUp(500);
});





</script>

</html>
