<?php 
include "database.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

if($ispost) {
      // plan name sent from form 

	$name = $_POST['planName'];
	echo $name;


	if(!ifExist("'".$name."'", 'PLANNUMBER' , 'PLAN')){
		try {
			insertIntoPlan($name);
			header('location: ./addAttToPlan');
		}catch (Exception $e){
			echo $e->getMessage();
			echo "Cannot Create Plan. Because the plan name exceeds maximum length.";
		}
	}else{
		echo "Cannot Create Plan. Because the Plan name has been used. Please use a new plan name";
	}
}

	//if(ifExist($name, 'GROUPID' , 'GROUPS') || !allresponsibleValid($resp,$adults) 
	//	|| !noSameName($adults,$children) || !notNULL1($adults,$contactInfo,$children,$resp) ||! numberMatch($adults,$contactInfo,$children,$resp)){
	//	echo !allresponsibleValid($resp,$adults);
	//}else{
	//	echo "Successfully Create Group";
	
// 	if(!ifExist("'".$name."'", 'PLANNUMBER' , 'PLAN')){
// 		try {
// 			insertInto("'".$name."'",'PLAN');
// 			header('location: ./addAttToPlan');
// 		}catch (Exception $e){
// 			echo $e->getMessage();
// 			echo "Cannot Create Plan. Because the plan name exceeds maximum length.";
// 		}
// 	}else{
// 		echo "Cannot Create Plan. Because the Plan name has been used. Please use a new plan name";
// 	}
// }


?>