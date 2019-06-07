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


function executeBoundSQL($cmdstr, $list) {
	/* Sometimes the same statement will be executed several times.
        Only the value of variables need to be changed.
	   In this case, you don't need to create the statement several
        times.  Using bind variables can make the statement be shared
        and just parsed once.
        This is also very useful in protecting against SQL injection
        attacks.  See the sample code below for how this function is
        used. */
        $success = true;
        $db_conn = OCILogon ("ora_gary1999", 'a42252965', "dbhost.students.cs.ubc.ca:1522/stu");
        if (!$db_conn) {
        	throw new Exception('Cannot Connect to db');
        }

        $statement = OCIParse($db_conn, $cmdstr);

        if (!$statement) {
        	echo "<br>Cannot parse this command: " . $cmdstr . "<br>";
        	$e = OCI_Error($db_conn);
        	echo htmlentities($e['message']);
        	$success = False;
        }

        foreach ($list as $bind => $val) {
			//echo $val;
			//echo "<br>".$bind."<br>";
        	OCIBindByName($statement, $bind, $val);
			unset ($val); // Make sure you do not remove this.
                              // Otherwise, $val will remain in an 
                              // array object wrapper which will not 
                              // be recognized by Oracle as a proper
                              // datatype.
		}
		$r = OCIExecute($statement, OCI_COMMIT_ON_SUCCESS);
		if (!$r) {
			echo "<br>Cannot execute this command: " . $cmdstr . "<br>";
			$e = OCI_Error($statement);
                // For OCIExecute errors pass the statement handle
			echo htmlentities($e['message']);
			echo "<br>";
			$success = False;
		}
		if(!$success){
			throw new Exception('Cannot execute this command'.$e['message']);
		}
		return $statement;

	}


	function ifExist($id, $keyname, $database){
		$list1 = array (
			":bind1" => $id);

		$command = "SELECT * FROM $database WHERE $keyname = :bind1 ";
		try{
			$stid = executeBoundSQL($command, $list1);
		}catch(Exception $e){
			echo $e.getMessage();
			echo "ERROR";
			return false;
		}
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
		$chd = executeSQL("SELECT * FROM YoungVisitor_include_isGuradedBy WHERE  younggroupID = '$GroupID'");

		while ($child =  oci_fetch_array($chd)) {
			array_push($Children, $child);
		}

		//$Children = oci_fetch_array(executeSQL("SELECT * FROM YoungVisitor_include_isGuradedBy WHERE  younggroupID = '$GroupID'"));

		return array('GS'=>$groupSize,'AD'=>$adults,'CH'=>$Children);
	}

	function updateGroupSize($GroupID){
		executeSQL("UPDATE groups SET GROUPSIZE = (SELECT count(*) FROM ((SELECT visitorName FROM AdultVisitor_include WHERE  groupID = '$GroupID') UNION (SELECT youngVisitorName FROM YoungVisitor_include_isGuradedBy WHERE  youngGroupID = '$GroupID')))");

	}


	function insertIntoGroups($name,$size,$password){
		$list1 = array (":bind1" => $name,
							":bind2" => $size,
							":bind3" => $password);
		executeBoundSQL("INSERT INTO groups VALUES ( :bind1 , :bind2, :bind3)", $list1);
	}

	function insertIntoAdults($adult,$groupID,$cont){
		$list1 = array (":bind1" => $adult,
							":bind2" => $groupID,
							":bind3" => $cont);
		executeBoundSQL("INSERT INTO AdultVisitor_include VALUES ( :bind1 , :bind2, :bind3)", $list1);
	}

	function insertIntoChildren($child,$groupID,$adult){
		$list1 = array (":bind1" => $child,
							":bind2" => $groupID,
							":bind3" => $adult);
		executeBoundSQL("INSERT INTO YoungVisitor_include_isGuradedBy VALUES ( :bind1 , :bind2, :bind3, :bind2 )", $list1);
	}

	?>