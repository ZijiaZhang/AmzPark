<?php
function executeSQL($command){
	$conn = OCILogon ("ora_gary1999", 'a42252965', "dbhost.students.cs.ubc.ca:1522/stu");
	if (!$conn) {
		throw new Exception('Cannot Connect to db');
	}
	$stid = OCIParse($conn, $command);
	if (!$stid) {
		#echo "<br>Cannot parse this command: ". "<br>";
		$e = OCI_Error($conn); 
           // For OCIParse errors, pass the connection handle.
		#echo htmlentities($e['message']);
		#$success = False;
		throw new Exception('Cannot parse this command'. $e['message']);
	}

	$r = OCIExecute($stid, OCI_COMMIT_ON_SUCCESS);
	if (!$r) {
		#echo "<br>Cannot execute this command: " .$command. "<br>";
		$e = oci_error($statement); 
           // For OCIExecute errors, pass the statement handle.
		#echo htmlentities();
		#$success = False;
		throw new Exception('Cannot execute this command'.$command.$e['message']);
	} else {
									#echo "<br>Command: success " .$command. "<br>";
	}
	return $stid;

}

function ifExist($id, $keyname, $database){
	$command = "SELECT * FROM $database WHERE $keyname = '$id'";
	$stid = executeSQL($command);

	return ($t = oci_fetch($stid));

}

function insertInto($item, $database){
	$command = "INSERT INTO $database VALUES ($item)";
	#echo $command;
	$stid = executeSQL($command);
}

function getMember($GroupID){
	$result = executeSQL("SELECT * FROM groups WHERE GROUPID = '$GroupID'");
	$row = oci_fetch_array($result);
	$groupSize = $row['GROUPSIZE'];
	#var_dump($groupSize);

	$adults = array();
	$adt = executeSQL("SELECT * FROM AdultVisitor_include WHERE  groupID = '$GroupID'");
	
	while ($adult =  oci_fetch_array($adt)) {
		array_push($adults, $adult);
	}
	
	$Children = array();
	$chd = executeSQL("SELECT * FROM AdultVisitor_include WHERE  groupID = '$GroupID'");
	
	while ($child =  oci_fetch_array($chd)) {
		array_push($Children, $child);
	}

	$Children = oci_fetch_array(executeSQL("SELECT * FROM YoungVisitor_include_isGuradedBy WHERE  younggroupID = '$GroupID'"));

	return array('GS'=>$groupSize,'AD'=>$adults,'CH'=>$Children);
}

function updateGroupSize($GroupID){
	executeSQL("UPDATE groups SET GROUPSIZE = (SELECT count(*) FROM AdultVisitor_include WHERE  groupID = '$GroupID') WHERE groupID = '$GroupID'");

}

?>