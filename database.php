<?php
	function executeSQL($command){
		$conn = OCILogon ("ora_gary1999", 'a42252965', "dbhost.students.cs.ubc.ca:1522/stu");
								if (!$conn) {
									echo "ERROR";
								}
								$stid = OCIParse($conn, $command);
								if (!$stid) {
									echo "<br>Cannot parse this command: ". "<br>";
									$e = OCI_Error($conn); 
           // For OCIParse errors, pass the connection handle.
									echo htmlentities($e['message']);
									$success = False;
								}

								$r = OCIExecute($stid, OCI_COMMIT_ON_SUCCESS);
								if (!$r) {
									echo "<br>Cannot execute this command: " .$command. "<br>";
									$e = oci_error($statement); 
           // For OCIExecute errors, pass the statement handle.
									echo htmlentities($e['message']);
									$success = False;
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
		echo $command;
		$stid = executeSQL($command);
	}

?>