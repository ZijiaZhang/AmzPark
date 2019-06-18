<?php
	include_once '../database.php';
	$name = $_POST["name"];
	$list1 = array( ":bind1" => $name);
	$r = executeBoundSQL("SELECT perform_time FROM Entertainments_Determin_Status_And_Arrange_Times1 WHERE name = :bind1",$list1);
	while($t = oci_fetch_array($r)){
		?>
		<option value = "<?php echo $t["PERFORM_TIME"];?>" ><?php echo $t["PERFORM_TIME"];?> </option>
		<?php
	}
?>