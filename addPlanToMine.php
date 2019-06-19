<?php 
include "database.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");


include_once 'session.php';
include_once 'database.php';
initializeSession();


if(checkSession()){
		//header('location: ./account');
	//echo "Your Session ID: ";
	var_dump(session_id());
	$name = $_SESSION['login_user'];
}else{
	header('location: ../login');
}


// if(isset($_GET['Message'])){
//     echo $_GET['Message'];
// }

if($ispost) {
      // username and password sent from form 
	var_dump($_POST);
	#print_r($_POST);
	//$groupID = $_POST['groupID'];
	$pname = $_POST['planName'];
	#echo $name;
	
	if(!ifExist2($name, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')){
		try {
			insertIntoMadeBy($name, $pname);
			$Message = "Plan added successfully";
			header('location: ./makePlan_exisiting/index.php?Message='.$Message);
		}catch (Exception $e){
			echo "Cannot Create Plan because of some error";
		}
	}else{
		$Message = "There is already a plan with the same name in your plans.";
		header('location: ./makePlan_exisiting/index.php?Message='.$Message);
		
	}
}


?>