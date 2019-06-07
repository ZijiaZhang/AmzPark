<?php
	include "../database.php";
	$list1 = array(
			":bind1" => $_POST["accountName"],
			":bind2" => $_POST["adultnm"],
			":bind3" => $_POST["contact"]

	);
	$r = executeBoundSQL("SELECT * FROM groups INNER JOIN AdultVisitor_include ON groups.groupID = AdultVisitor_include.groupID WHERE groups.groupID = :bind1 and visitorname = :bind2 and CONTACT_INFO = :bind3",$list1);
	$row = OCI_Fetch_Array($r, OCI_BOTH);
	var_dump($row);
	if($row){
		$newpass = md5(generateRandomString());
		$list1 = array(
				":bind1" => $_POST["accountName"],
				":bind2" => $newpass
		);
		$r = executeBoundSQL("UPDATE GROUPS SET password = :bind2 WHERE groupID = :bind1", $list1);
		header("location: ?groupnm=".$_POST["accountName"]."&temppass=$newpass");
	}else{
		header("location:?message=fail");
	}
	

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>