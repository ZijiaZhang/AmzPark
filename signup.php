<?php 
include "database.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");

if($ispost) {
      // username and password sent from form 
	function processArray(&$arr){
		if(!$arr)
			$arr = array();
		array_walk($arr, create_function('&$val', 
			'$val = trim($val);'));
		$arr = array_unique($arr);
		
		if (($key = array_search("", $arr)) !== false) {
			unset($arr[$key]);
		}
		#echo "<br>";
		#var_dump($arr);
		return $arr;
	}
	#print_r($_POST);
	$name = $_POST['username'];
	#echo $name;
	$password = md5($_POST['password']);
	#echo $password;
	
	$adults = $_POST['adults'];
	processArray($adults);
	#echo "adult:";
	#print_r($adults);
	

	$contactInfo = $_POST['contact'];
	processArray($contactInfo); 
	#echo "contact:";
	#print_r($contactInfo);
	#print_r($adults);
	
	$children = $_POST['children'];
	processArray($children); 
	#echo "children";
	#print_r($children);

	#print_r($children);
	$resp = $_POST['responsible'];
	processArray($resp); 
	#echo "respon:";
	#print_r($resp);

	$size = count($children) + count($adults);

	function notNULL1($adults,$contactInfo,$children,$resp){
		return (!in_array('', array_merge(array_values($adults),array_values($contactInfo),array_values($children),array_values($resp))));
	}


	function allresponsibleValid($resp,$adults){
		foreach ($resp as $r) {
			if(!in_array($r, $adults)){
				echo $r;
				return false;
			}
		}
		return true;
	}

	function numberMatch($adults,$contactInfo,$children,$resp){
		return count($adults) == count($contactInfo) && count($children) == count($resp);
	}

	function noSameName($adults,$children){
		$temp = array_merge(array_values($adults),array_values($children));
		return count(array_unique($temp)) == count($temp);
	}


	//if(ifExist($name, 'GROUPID' , 'GROUPS') || !allresponsibleValid($resp,$adults) 
	//	|| !noSameName($adults,$children) || !notNULL1($adults,$contactInfo,$children,$resp) ||! numberMatch($adults,$contactInfo,$children,$resp)){
	//	echo !allresponsibleValid($resp,$adults);
	//}else{
	//	echo "Successfully Create Group";
	if(!ifExist($name, 'GROUPID' , 'GROUPS')){
		try {
			insertIntoGroups($name,$size,$password);
			try{
				for($i =0 ;$i < count($adults) ;$i++){
					$adult = $adults[$i];
					$cont  = $contactInfo[$i];
					insertIntoAdults($adult,$name,$cont);
				}
				for($i =0 ;$i < count($children) ;$i++){
					$child = $children[$i];
					$adult = $resp[$i];

					insertIntoChildren($child,$name,$adult);
				}
				#Signup Successful
				header('location: ../login?message=signup');
			}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				$list1 = array(":bind1" => $name ); 
				executeBoundSQL("DELETE FROM groups WHERE groupID = :bind1" , $list1);
			}
		}catch (Exception $e){
			echo "Cannot Create Group. Because the group name exceeds maximum length.";
		}
	}else{
		echo "Cannot Create Group. Because the group name has been used.";
	}
}


?>