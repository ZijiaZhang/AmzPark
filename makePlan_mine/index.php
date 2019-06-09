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

<?php
//include_once '../login.php';
include_once '../session.php';
include_once '../database.php';
initializeSession();
#print_r($_SESSION);

if(checkSession()){
        //header('location: ./account');
    echo "Your Session ID: ";
    var_dump(session_id());
    $name = $_SESSION['login_user'];
}else{
    header('location: ../login');
}
?>

<section id = "Mine" >
	<div class="simple-chord--wrapper component-wrapper" style="background-color: rgba(100,100,100,0.3);">
		<head>
        <title>My Plans</title>
    </head>
    <body>
        <table>
        <thead>
            <tr>
                <td>Plan Name</td>
                <td>Attractions in this plan</td>
            </tr>
        </thead>
        <tbody>
        <?php
            include_once '../database.php';
            try{
            $results = executeSQL("SELECT B.PLANNUMBER, LISTAGG(B.ATTNAME, ',') WITHIN GROUP (ORDER BY B.ATTNAME) FROM ofVisiting B, madeby A WHERE A.PLANNUMBER = B.PLANNUMBER AND A.groupID='$name' GROUP BY B.PLANNUMBER" );
            }catch ( Exception $e){
                echo $e->getMessage();
            }
          //  echo "OK";
            while($row =  OCI_Fetch_Array($results)) {
            ?>
                <tr>
                    <td><?php echo $row['PLANNUMBER'];?></td>
                    <td><?php echo $row[1];?></td>
                </tr>
             
            <?php
            }
            ?>
            </tbody>
            </table>
    </body>
	</div>

</section>








</html>
