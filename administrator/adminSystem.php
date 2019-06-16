<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>AdminSystem for AmzPark</title>
  <!-- Styels -->
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <header>
    <ul>
      <!-- contact info begin -->
      <li><a href="#admininfo">Admins Info</a></li>
      <li><a href="#visitorinfo">Visitors Info</a></li>
      <li><a href="#maintenanceInfo">Maintenances Info</a></li>
      <!-- contact info end -->

      <!-- management begin -->
      <li><a href="#attractionManagement">Attractions Management</a></li>
      <li><a href="#entertainmentManagement">Entertainments Management</a></li>
      <li><a href="#repairsManagement">Repairs Management</a></li>
      <!-- management end -->
    </ul>
  </header>
  <div id="admininfo" class="content-wrap">
    <p>The contact information of all administrators:</p>
    <form method="GET" action="adminSystem.php">
      <p><input type="submit" value="Display" name="displayadmininfo"></p>
    </form>
    <!-- todo -->

  </div>

  <!-- visitor info -->
  <div id="visitorinfo" class="content-wrap">
    <p>Find contact information of the visitor:</p>
    <p>
      <font size="2"> Group ID#
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Visitor Name
      </font>
    </p>
    <form method="POST" action="adminSystem.php">

      <p><input type="text" name="groupID" size="18"></input>
        <input type="text" name="visitorName" size="18"></input></p>

      <p><input type="submit" value="Young Visitor" name="findGuardian"></input>
        <input type="submit" value="Adult Visitor" name="findContactInfo"></input></p>
    </form>
    <!-- todo -->

  </div>
  <!-- maintenanceInfo -->
  <div id="maintenanceInfo" class="content-wrap">
    <p>Find contact information of specific maintenance facility:</p>
    <p>
      <font size="2"> Facility Name</font>
    </p>
    <form method="GET" action="adminSystem.php">
      <p><input type="text" name="facilityName" size="30">
        <input type="submit" value="Submit" name="findFacility"></p>
    </form>

  </div>
  <!-- attractions management -->
  <div id="attractionManagement" class="content-wrap">
    <p>Update the status of the attractions:</p>
    <p>
      <font size="2">Attraction NAME
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;
        Updated Status
      </font>
    </p>
    <!-- todo -->
    <form method="POST" action="adminSystem.php">
      <p><input type="text" name="attractionName" size="20"></input>
        <input type="text" name="attractionStatus" size="15"></input>
        <input type="submit" value="Update Status" name="updateAttraction"></input></p>
    </form>
    <form method="POST" action="adminSystem.php">
      <p><input type="submit" value="Show the status of all attractions" name="displayAttr"></input></p>
    </form>
    <!-- todo -->
  </div>
  <!-- entertainment management -->
  <div id="entertainmentManagement" class="content-wrap">
    <p>Display current reservation for each entertainment:</p>
    <form method="POST" action="adminSystem.php">
      <p><input type="submit" value="Display" name="displayReservation"></input></p>
    </form>
    <!-- todo; must include perform time -->
    <p>Update the status of the entertainment:</p>
    <p>
      <font size="2">Entertainment Name
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Perform Time
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Updated status
      </font>
    </p>
    <form method="POST" action="adminSystem.php">
      <p><input type="text" name="entertainmentName" size="18"></input>
        <input type="text" name="performTime" size="18"></input>
        <input type="text" name="entertainmentStatus" size="18"></input>
        <input type="submit" value="Update Status" name="updateEntertainment"></input></p>
    </form>
    <!-- todo -->
  </div>
  <!-- repairs management -->
  <div id="repairsManagement" class="content-wrap">
    <p>Display current repairs record:</p>
    <form method="POST" action="adminSystem.php">
      <p><input type="submit" value="Display" name="displayRepairs"></input></p>
    </form>
    <!-- todo -->
    <p>Add repair record:</p>
    <p>
      <font size="2">Facility Name
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Attraction Name
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Repair Date
      </font>
    </p>
    <form method="POST" action="adminSystem.php">
      <p><input type="text" name="repairFacility" size="20"></input>
        <input type="text" name="repairAttraction" size="18"></input>
        <input type="text" name="repairDate" size="15"></input>
        <input type="submit" value="Submit" name="submitRepair"></input></p>
    </form>
  </div>
</body>

</html>
<?php
include "database.php";
if ($db_conn) {
  // if (array_key_exists('displayadmininfo', $_POST)) {
  //   executePlainSQL("select * from administrator2");
  //   OCICommit($db_conn);
  // }
  if (array_key_exists('displayadmininfo', $_GET)) {
    $result = executePlainSQL("select * from administrator2");
    $columnNames = array("Duty Area", "Contact Info");

  } else if (array_key_exists('findFacility', $_GET)) {
    $result = executePlainSQL("select * from facility where name='".$_GET['facilityName']."'");
    $columnNames = array("Name", "Contact Info");

  } else if (array_key_exists('findGuardian',$_POST)) {
    $result = executePlainSQL("select young.yname, contact_info from adult inner join young on
    adult.aname=young.aname
    where young.ygid='".$_POST['groupID']."' and young.yname='".$_POST['visitorName']."'");
    $columnNames = array("Visitor Name", "Guardian Contact Info");
  } else if (array_key_exists('findContactInfo', $_POST)) {
    $result = executePlainSQL("select aname, contact_info from adult where gid='".$_POST['groupID']."' and aname='".$_POST['visitorName']."'");
    $columnNames = array("Visitor Name", "Contact Info");
  } else if (array_key_exists('updateAttraction', $_POST)) {
    executePlainSQL("update attraction set status='".$_POST['attractionStatus']."' where att_name='".$_POST['attractionName']."'");
    $columnNames = array("Name","Location","Capacity","Status","Open Time", "Close Time","Admin ID");
    $result = executePlainSQL("select * from attraction");
  } else if (array_key_exists('displayAttr', $_POST)) {
    $columnNames = array("Name","Location","Capacity","Status","Open Time", "Close Time","Admin ID");
    $result = executePlainSQL("select * from attraction");
  } else if (array_key_exists('displayReservation', $_POST)) {
    $columnNames = array("Name","Perform Time", "#Reservation");
    $result = executePlainSQL("select entertainmentname, count(*), perform_time from reservation group by entertainmentname, perform_time");
  } else if (array_key_exists('updateEntertainment', $_POST)) {
    $columnNames = array("Name", "Perform Time", "Status");
    executePlainSQL("update entertainment set status='".$_POST['entertainmentStatus']."'
    where name='".$_POST['entertainmentName']."' and perform_time='".$_POST['performTime']."'");
    $result = executePlainSQL("select * from entertainment");
  } else if (array_key_exists('displayRepairs', $_POST)) {
    $columnNames = array("Maintenance Facility Name", "Attraction Name", "Date");
    $result = executePlainSQL("select * from repair");
  } else if (array_key_exists('submitRepair', $_POST)) {
    $columnNames = array("Maintenance Facility Name", "Attraction Name", "Date");
    executePlainSQL("insert into repair values('".$_POST['repairFacility']."','".$_POST['repairAttraction']."',to_date('".$_POST['repairDate']."','YYYY-MM-DD'))");
    $result = executePlainSQL("select * from repair");
  }
      printTable($result, $columnNames);


  OCILogoff($db_conn);
} else {
  echo "cannot connect";
  $e = OCI_Error();
  echo htmlentites($e['message']);
}

?>
