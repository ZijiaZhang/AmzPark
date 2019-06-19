<?php 
include "database.php";

$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

include_once 'session.php';
include_once 'database.php';

//itializeSession();

if(checkSession()){
		//header('location: ./account');
	//echo "Your Session ID: ";
	var_dump(session_id());
	$name = $_SESSION['login_user'];
}else{
	header('location: ../login');
}


if($ispost) {
	$pname = $_POST['planName'];
	#echo $name;
	

	if(!ifExist("'".$pname."'", 'PLANNUMBER' , 'PLAN')){
		try {
			insertIntoPlan($pname);
		}catch (Exception $e){
			echo $e->getMessage();
			echo "Cannot Create Plan. Because the plan name exceeds maximum length.";
		}
	}else{
		echo "Cannot Create Plan. Because the Plan name has been used. Please use a new plan name";
	}
}

	

// 	if(!ifExist2($name, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')){
// 		try {
// 			insertIntoMadeBy($name, $pname);
// 			header('location: ./addAttToPlan');
// 		}catch (Exception $e){
// 			echo "Cannot Create Plan";
// 		}
// 	}else{
// 		echo "There is already a plan with the same name in your plans. Please use a new name.";
// 	}
// }


?>