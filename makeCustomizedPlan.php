<?php 
include "database.php";
include "session.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");


//include_once 'session.php';
//include_once 'database.php';
initializeSession();


if(checkSession()){
	var_dump(session_id());
	$gname = $_SESSION['login_user'];
}else{
	header('location: ../login');
}


var_dump($_POST);

if($ispost) {
	$pname = $_POST['planName'];
	$aname = $_POST['attName'];

	if (array_key_exists('createPlan', $_POST)) {
		
		if(!ifExist("'".$pname."'", 'PLANNUMBER' , 'PLAN')){
			try {
		//	insertInto("'".$pname."'",'PLAN');
				insertIntoPlan($pname);
			}catch (Exception $e){
				echo $e->getMessage();
				echo "Cannot Create Plan. Because the plan name exceeds maximum length.";
			}
		}
		else{
			echo "Cannot Create Plan. Because the Plan name has been used. Please use a new plan name";
		}


		if(!ifExist2($gname, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')){
			try {
				insertIntoMadeBy($gname, $pname);
				header('location: ./addAttToPlan?message=1');
			}catch (Exception $e){
				echo "Cannot Create Plan";
			}
		}
		else{
			echo "There is already a plan with the same name in your plans. Please use a new name.";
		}
	}


	if (array_key_exists('addAtt', $_POST)){
	//	$aname = $_POST['attName'];

		if(!ifExist2($pname, $aname, 'PLANNUMBER' , 'ATTNAME', 'ofVisiting')){
			try {
				insertIntoOfVisiting($pname,$aname);
				header('location: ./addAttToPlan?success=1');
			}catch (Exception $e){
				echo "Error. Cannot add it to the plan.";
			}
		}
		else{
			echo "This attraction is already in this plan";
		}


	}
}





?>