 <html>
<p> <font size = "6"> <p style="text-align:center;">Entertainment Reservation System <p>


<p><font size="3"> Entertainment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Perform Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;Group ID </font></p>

<form method = "POST" action="reservation.php">
  <p><input type="text" style="font-size:16pt;" name="enterName" size="15">
     <input type="text" style="font-size:16pt;" name="time" size="15">
     <input type="text" style="font-size:16pt;" name="groupID" size="10">
	 <input type="submit" style="font-size:20pt;" value="insert" name="insertsubmit"></p>
</form>

<?php
include "database.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

$conNo = substr(md5(uniqid(rand(), true)),0,7);
if ($ispost){
	if (array_key_exists('insertsubmit', $_POST)) {
	$enterName = $_POST['enterName'];
	$time = $_POST['time'];
	$groupID = $_POST['groupID'];
	if (!ifExist('enterName','name', 'Entertainments_Determin_Status_And_Arrange_Times1')) {
		echo "Error: The entertainment does not exit!";
	}
	else if (!fExist('time','perform_time', 'Entertainments_Determin_Status_And_Arrange_Times1')) {
		echo "Error: The selected perform time does not exit!";
	}
	else if (!fExist('groupID','groupID', 'Groups')) {
		echo "Error: Your group does not exit!";
	}
	else {
		try {
			insertIntoReservation($conNo,$groupID,$enterName,$time);
			header('location: ./makeReservation');
		} catch (Exception $e) {
			echo "Error";
		}
		
		
	}
}
}

?>
</html>