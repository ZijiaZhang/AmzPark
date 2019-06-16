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

select {
    margin: 0;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:5px;
    -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    background: #f8f8f8;
    color:#888;
    border: 1px solid black;
    outline:none;
    display: inline-block;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    cursor:pointer;
    font-size: 24px;
    padding: 15px 0px 15px 8px;
    box-shadow: inset 4px 6px 10px -4px rgba(0, 0, 0, 0.3), 0 1px 1px -1px rgba(255, 255, 255, 0.3);
   
}

.selectWrap {position:relative}


.selectWrap:after {
    content:'<>';
    font:24px "Consolas";
    color:#aaa;
    -webkit-transform:rotate(90deg);
    -moz-transform:rotate(90deg);
    -ms-transform:rotate(90deg);
    transform:rotate(90deg);
    right:8px; top:0px;
    padding:0 0 2px;
    border-bottom:1px solid #ddd;
    position:absolute;
    pointer-events:none;
    
}
.selectWrap:before {
    content:'';
    right:6px; top:0px;
    width:20px; height:20px;
    background:#f8f8f8;
    position:absolute;
    pointer-events:none;
    display:block;
}

</style>


</body>
<div style="height: 100px"></div>


<?php
include '../signup.php';
$allAdult = array();
?>


<div class = "formContainer">
	<h1>Register</h1>
	<div class="fullWidth" style="text-align: center; color: red;"><?php if(isset($Message)) echo $Message; ?></div>
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
					array_push($allAdult, $add);
					$contect = $_POST["contact"][$i];
					if(trim($add)!='' || trim($contect)!='')
						?><tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '<?php echo $add;?>' required></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = '<?php echo $contect; ?>' required></td><td> <button type = button class = 'delete'>DELETE</button></td></tr>
			<?php	}
			}else{
				?><tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '' required></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = '' required></td><td> <button type = button class = 'delete'>DELETE</button></td></tr><?php
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
						?>
		<tr><td><input type='text' name='children[]' placeholder = 'Name Of the Children' value = '<?php echo $chd;?>' required> </td>
			<td> <label class = "selectWrap"> <select name = 'responsible[]' placeholder= 'Responsible Adult' value = '' required>
			<option value='' disabled> Responsible Adult</option>
			<?php foreach($allAdult as $ad){?>
				<option value = '<?php echo $ad;?>' <?php if($res == $ad) echo "selected"?>>
				<?php echo $ad;?>
				</option>
			<?php }?> 
				</select></label></td><td> 
			<button type = button class = 'delete'>DELETE</button></td></tr>
<?php
				}
			}

			?>

		</table>

		<input type = "submit" value = " Submit " name="submit" autofocus /><br />
	</form>
</div>

<script>
// Global variables
//var alladult = new Array();

$('input[name="adults[]"]').on('input',function(e){
		//updateAdult();
	});
function updateAdult(){
	var alladult = new Array();
	var x = document.getElementsByName("adults[]");
	for (i = 0; i < x.length; i++) {
		alladult.push(x[i].value);
	}
	
	var x = document.getElementsByName("responsible[]");
	for (i = 0; i < x.length; i++) {
		var count = x[i].childElementCount;
		
		//x[i].innerHTML = '';
		for(j =0; j<alladult.length;j++){
			if(j+1 < count){
				x[i].options[j+1].innerHTML = '';
				x[i].options[j+1].appendChild( document.createTextNode(alladult[j]) );
				x[i].options[j+1].value = alladult[j];
			}else{
			x[i].appendChild(createoption(alladult[j]));
			}
		}
		for(j = alladult.length+1; j < count;j++){
			x[i].removeChild(x[i].options[j]);		
		}
	}
	
}

function createoption(v){
	var opt = document.createElement('option');
	opt.appendChild( document.createTextNode(v) );

	// set value property of opt
	opt.value = v; 
	return opt;
}

var $deletething = $('.del_thing');

$('#addAdult').click(function(){
	$thing_table = $('.adultsTable');
  // if input is empty, it won't add an empty row
    // new thing is added to end of table
    // change to prepend to add to the beginning of table
    $thing_table.append("<tr><td><input type='text' name='adults[]' placeholder='Name of an adult' value = '' required></td><td><input type='text' name='contact[]' placeholder='Contect Info' value = '' required></td><td> <button type = button class = 'delete'>DELETE</button></td></tr>");

  // empties the input when sumbit is clicked
	updateAdult();
});

$('#addChildren').click(function(){
	$thing_table = $('.childrenTable');
    $thing_table.append("<tr><td><input type='text' name='children[]' placeholder = 'Name Of the Children' value = '' required></td><td> <label class = 'selectWrap'> <select name = 'responsible[]' value = '' required><option value='' disabled selected> Responsible Adult</option></select></label></td><td> <button type = button class = 'delete'>DELETE</button></td><tr>");
	updateAdult();
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

$('.mytable').on('input', 'input[name="adults[]"]',function(e){
updateAdult();
});

$('.mytable').on('click', '.delete', function(){
    var row = this.parentElement.parentElement;
  row.parentElement.removeChild(row);
	updateAdult();
});

//updateAdult();


</script>

</html>
