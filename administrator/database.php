
<?php

$success = True;
$db_conn = OCILogon("ora_yuxinch", "a14635700",
                    "dbhost.students.cs.ubc.ca:1522/stu");

function executePlainSQL($cmdstr) {
     // Take a plain (no bound variables) SQL command and execute it.
	//echo "<br>running ".$cmdstr."<br>";
	global $db_conn, $success;
	$statement = OCIParse($db_conn, $cmdstr);
     // There is a set of comments at the end of the file that
     // describes some of the OCI specific functions and how they work.

	if (!$statement) {
		echo "<br>Cannot parse this command: " . $cmdstr . "<br>";
		$e = OCI_Error($db_conn);
           // For OCIParse errors, pass the connection handle.
		echo htmlentities($e['message']);
		$success = False;
	}

	$r = OCIExecute($statement, OCI_DEFAULT);
	if (!$r) {
		echo "<br>Cannot execute this command: " . $cmdstr . "<br>";
		$e = oci_error($statement);
           // For OCIExecute errors, pass the statement handle.
		echo htmlentities($e['message']);
		$success = False;
	} else {

	}
	return $statement;

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
        global $db_conn, $success;

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

  function printTable($resultFromSQL, $namesOfColumnsArray)
  {
      echo "<table>";
      echo "<tr>";
      // iterate through the array and print the string contents
      foreach ($namesOfColumnsArray as $name) {
          echo "<th>$name</th>";
      }
      echo "</tr>";

      while ($row = OCI_Fetch_Array($resultFromSQL, OCI_BOTH)) {
          echo "<tr>";
          $string = "";

          // iterates through the results returned from SQL query and
          // creates the contents of the table
          for ($i = 0; $i < sizeof($namesOfColumnsArray); $i++) {
              $string .= "<td>" . $row["$i"] . "</td>";
          }
          echo $string;
          echo "</tr>";
      }
      echo "</table>";
  }

  function ifExist2($v1, $v2, $keyname1, $keyname2, $database){
		$list1 = array (
			//":bind1" => $gid,
			":bind1" => $v1,
			//":bind3" => $pn,
			":bind2" => $v2);
		$command = "SELECT * FROM $database WHERE $keyname1 = :bind1 AND $keyname2 = :bind2";
		try{
			$stid = executeBoundSQL($command, $list1);
		}catch(Exception $e){
			echo $e.getMessage();
			return false;
		}
		return ($t = oci_fetch($stid));
	}






 ?>
