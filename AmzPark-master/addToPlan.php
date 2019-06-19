<?php 
include "database.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

if($ispost) {
      // username and password sent from form 
	
	#print_r($_POST);
	//$groupID = $_POST['groupID'];
	$pname = $_POST['planName'];
	$aname = $_POST['attName'];
	#echo $name;
	

    function ifExist2($gid, $pn, $keyname1, $keyname2, $database){
		$list1 = array (
			//":bind1" => $gid,
			":bind1" => $gid,
			//":bind3" => $pn,
			":bind2" => $pn);

		$command = "SELECT * FROM $database WHERE $keyname1 = :bind1 AND $keyname2 = :bind2";
		try{
			$stid = executeBoundSQL($command, $list1);
		}catch(Exception $e){
			echo $e.getMessage();
			return false;
		}
		return ($t = oci_fetch($stid));

	}
	
	if(!ifExist2($pname, $aname, 'PLANNUMBER', 'ATTNAME' , 'ofVisiting')){
		try {
			insertIntoOfVisiting($pname, $aname);
			header('location: ./myaccount');
		}catch (Exception $e){
			echo "Cannot add to this Plan";
		}
	}else{
		echo "The sttraction is already in this plan.";
	}
}


?>


	