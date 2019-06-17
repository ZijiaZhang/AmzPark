<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>


<?php if(isset($_GET['Message'])){
$Message = $_GET['Message'];
}

?>
<p><?php echo $Message;?></p>


<?php
$pname = $_GET['planName'];
?>

<form action = "../addAttToPlan/index.php" method="post">
	<input type = "hidden" name = "planName" value = "<?php echo $pname; ?>" />
	<input type="submit" name = "addAtt" value = "Continue adding attraction to same plan" />
</form>



<a href="../makePlan_homepage"><button>I am done with this plan. Go back to make plan homepage</button> </a>
