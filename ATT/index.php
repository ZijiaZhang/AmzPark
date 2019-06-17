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

<body style="margin: 0px;" onload="initialize()" onresize="initialize()">
<!-- 	<div class="slide-item" style="background-image:url(../server_files/images/park.jpg);background-repeat:no-repeat;background-position:left top;background-size:cover;height: 100%; position: fixed;float:all;width: 100%; opacity: 1;"></div>
	<div id = "nav-placeholder"> -->
	



</div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>






<section id = "Mine" style="margin: 30px" >
	<!-- <div class="simple-chord--wrapper component-wrapper" style="background-color: rgba(100,100,100,0.7);"> -->
		<!-- <head>
        <title>Information about Booster</title>
    </head> -->
    <body>
        <table>
        <?php
        	$ATTNAME = "Booster";
        	if(isset($_GET["attname"])){
        		$ATTNAME = $_GET["attname"];
        	}
            include '../database.php';
            $list1 = array(":bind1"=> $ATTNAME);
            try{
            $results = executeBoundSQL("SELECT A.ATT_NAME, A.LOCATION, A.CAPACITY, A.STATUS, A.OPEN_TIME, A.CLOSE_TIME, B.EXPECTED_WAITING_TIME, C.NAME, D.CONTACT_INFO  FROM Attractions_Insepect_And_Determines_Status1 A, Attractions_Insepect_And_Determines_Status2 B, Administrator1 C, Administrator2 D WHERE A.ATT_NAME = :bind1 AND  A.CAPACITY = B.CAPACITY AND A.ADM_ID = C.ADM_ID AND C.DUTYAREA = D.DUTYAREA",$list1);
        }catch (Exception $e){
        	echo "There is some error in getting the information about this attraction.";
        }
            $row = OCI_Fetch_Array($results, OCI_BOTH); ?>
                <tr>
                    <th>Name</th>
                    <td><?php echo $row['ATT_NAME'];?></td>
                </tr>
                 <tr>
                    <th>Location</th>
                    <td><?php echo $row['LOCATION'];?></td>
                </tr>
                 <tr>
                    <th>Capacity</th>
                    <td><?php echo $row['CAPACITY'];?></td>
                </tr>
                 <tr>
                    <th>Expected waiting time</th>
                    <td><?php echo $row['EXPECTED_WAITING_TIME'];?></td>
                </tr>
                 <tr>
                    <th>Open or under repair</th>
                    <td><?php echo $row['STATUS'];?></td>
                </tr>
                 <tr>
                    <th>Open time</th>
                    <td><?php echo $row['OPEN_TIME'];?></td>
                </tr>
                 <tr>
                    <th>Close time</th>
                    <td><?php echo $row['CLOSE_TIME'];?></td>
                </tr>
                 <tr>
                    <th>Administrator Name</th>
                    <td><?php echo $row['NAME'];?></td>
                </tr>
                 <tr>
                    <th>Administrator Contact Information</th>
                    <td><?php echo $row['CONTACT_INFO'];?></td>
                </tr>
            </table>
    </body>
	<!-- </div> -->

	<a href="../addAttToPlan/index.php"><button>GO BACK To Previous Page</button> </a>

</section>



<section id = "info" >
	<div class="simple-chord--wrapper component-wrapper" style="background-color: rgba(100,100,100,0.7);">
		<div class="simple-chord--inner" style="opacity: 1; color: white">
			<div class="h-font h2">Contact Us</div>
			<div class="simple-chord--text body-text">
				<div> 
					<div>E-mail: &nbsp;<a class= "emaillink" href="mailto:abcd@gmail.com">&nbsp;&nbsp; abcd@gmail.com</a>
					</div>
					<div> Phone: &nbsp;&nbsp; (123)456-7890</div>
					<div><br></div>2205 Lower Mall<br>
					<div> Vancouver, BC, Canada</div>
					<div>V6T1Z4<br></div> 
				</div>
			</div>
		</div>
	<!-- </div> -->

</section>



<div class="component-wrapper">
	<div style="background-color: rgba(0,0,0,1);width: 100%">

		<div class="footer">

			<div>
				<div style="text-align: center; color: white;">
				</div>
			</div>
			<div class="links">
				<a  href="https://github.com/ZijiaZhang99">
					<img src = "../server_files/icons/github-circle.png" >
				</a>
			</div>
		</div>
	</div>
</div>


</body>




</html>
