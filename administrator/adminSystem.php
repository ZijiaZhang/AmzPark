<?php
include "database.php";


?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>AdminSystem for AmzPark</title>
  <!-- Styels -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" type="text/css" href="../server_files/css/mycss.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link href="https://fonts.googleapis.com/css?family=Muli:400,700|Overpass+Mono" rel="stylesheet">
</head>

<body>

  <div id = "nav-placeholder">

  </div>
  <script>
    $(function(){
      $("#nav-placeholder").load("../navbar.html");
    });
  </script>
  <div class = "nvbarSpliter" style="height: 100px"></div>

  <style>
  .mainContainer{
    display: flex;
    width: 100%;
    position: fixed;
    bottom: 0;
    top: 100px;
  }
  .left-sidebar{
    width: 40%;
    overflow-y: scroll;
    height: 100%;
    padding: 0 1% 1% 1%;
  }
  .table-Display{
    width: 50%;
    height: 100%;
    overflow-y: scroll;
    border-left: 2px;
    border-color: grey;
    border-style: solid;
  }
  .tableWrap{
    width: -webkit-fit-content; 
    width: -moz-fit-content; 
    margin: auto;
  }

  table{
    border-collapse: collapse;
  }
  table tr td{
    border-color: black;
    border-width: 2px;
    border-style: solid;
  }
  table tr th{
    border-color: black;
    border-width: 2px;
    border-style: solid;
  }
  input[type="submit"]{
    background: #4d90fe;
    border-color: #3079ed;
    display: block;
    color: #fff;
    border-radius: 5px;
    padding: 8px 8px 8px 8px;
  }
  h1{
    font-size: 1.5em;
    font-weight: bold;
    color: #f99500;
    font-family: 'Muli', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  }
  hr{width: 90%;}

  header ol li a{
    text-decoration: none;
    text-decoration-style: none;
    color: blue;
  }
  body{
    font-family: 'Muli', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 1.2em;
    margin: 0 auto;
    letter-spacing: .4px;
    color: #0d242c;
    background: #ebf4ee;
  }
</style>
<div class = "mainContainer"> 
  <div class = "left-sidebar">

    <header>
      <h1> Quick naviagation</h1>
      <ol>
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
      </ol>
    </header>
    <div id="admininfo" class="content-wrap">
      <h1>Admins Info</h1>
      <p>The contact information of all administrators:</p>
      <form method="GET" action="adminSystem.php">
        <p><input type="submit" value="Display" name="displayadmininfo"></p>
      </form>
      <!-- todo -->

    </div>
    <hr>
    <!-- visitor info -->
    <div id="visitorinfo" class="content-wrap">
      <h1>Visitor Info</h1>
      <p>Find contact information of the visitor:</p>
      <div class="tableWrap">
        <table>
          <tr>
            <th> Group ID# </th>
            <th>Visitor Name</th>
            <th> Type</th>
          </tr>
          <tr>
            <form method="POST" action="adminSystem.php">
              <td>
                <select name="groupID" class="form-contral form-control-sm">
                  <?php
                  $resultSelection = executeSQL("select groupid from groups");
                  while ($rs = OCI_Fetch_Assoc($resultSelection)) {
                    foreach ($rs as $option) {
                      echo "<option value='$option'>$option</option>\n";
                    }
                  } ?>
                </select>
              </td>
              <td>
                <input type="text" name="visitorName" size="18"></input>
              </td>

              <td>
                <input type="submit" value="Young Visitor" name="findGuardian"></input>
                <input type="submit" value="Adult Visitor" name="findContactInfo"></input>
              </td>
            </form>
            <!-- todo -->
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <!-- maintenanceInfo -->
    <div id="maintenanceInfo" class="content-wrap">
      <h1>Maintenance Info</h1>
      <p>Find information of specific maintenance facility:</p>
      <div class="tableWrap">
        <table>
          <tr>
            <th>
             Facility Name
           </th>
           <th>
             Action
           </th>
         </tr>
         <tr>
          <form method="GET" action="adminSystem.php">
            <td>
              <select name="facilityName" class="form-contral form-control-sm">
                <?php
                $resultSelection = executeSQL("select name from MAINTENANCEFACILITY");
                while ($rs = OCI_Fetch_Assoc($resultSelection)) {
                  foreach ($rs as $option) {
                    echo "<option value='$option'>$option</option>\n";
                  }
                } 
                ?>
              </select>
            </td>
            <td>
              <input type="submit" value="Submit" name="findFacility">
            </td>
          </form>
        </tr>
      </table>
    </div>
  </div>
  <hr>
  <!-- attractions management -->
  <div id="attractionManagement" class="content-wrap">
    <h1>Arrtaction Management</h1>
    <p>Update the status of the attractions:</p>
    <div class="tableWrap">
      <table>
        <tr><th>Attraction Name</th>
          <th>Updated Status</th>
          <th> Action</th>
        </tr>
        <tr>
          <!-- todo -->
          <form method="POST" action="adminSystem.php">
            <td>
              <select name="attractionName" class="form-contral form-control-sm">
                <?php
                $resultSelection = executeSQL("select att_name from ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1");
                while ($rs = OCI_Fetch_Assoc($resultSelection)) {
                  foreach ($rs as $option) {
                    echo "<option value='$option'>$option</option>\n";
                  }
                } ?>
              </select>
            </td>
            <td>
              <input type="text" name="attractionStatus" size="15"></input>
            </td>
            <td>
              <input type="submit" value="Update Status" name="updateAttraction"></input>
            </td>

          </form>
        </tr>
      </table>
    </div>

    <form method="POST" action="adminSystem.php">
      <p><input type="submit" value="Show the status of all attractions" name="displayAttr"></input></p>
    </form>
    <!-- todo -->
  </div>
  <hr>
  <!-- entertainment management -->
  <div id="entertainmentManagement" class="content-wrap">
    <h1> Entertainment Managgement</h1>
    <p>Display current reservation for each entertainment:</p>
    <form method="POST" action="adminSystem.php">
      <p><input type="submit" value="Display" name="displayReservation"></input></p>
    </form>
    <!-- todo; must include perform time -->

    Update the status of the entertainment:
    <div class="tableWrap">
      <table>
        <tr>
          <th>
            Entertainment Name
          </th>
          <th>
            Perform Time
          </th>
          <th>
            Updated status
          </th>
          <th>
            Action
          </th>
        </tr>
        <tr>
          <form method="POST" action="adminSystem.php">
            <td>
              <select name="entertainmentName" class="form-contral form-control-sm">
                <?php
                $resultSelection = executeSQL("select distinct name from ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1");
                while ($rs = OCI_Fetch_Assoc($resultSelection)) {
                  foreach ($rs as $option) {
                    echo "<option value='$option'>$option</option>\n";
                  }
                } ?>
              </select>
            </td>
            <td>
              <input type="text" name="performTime" size="18"></input>
            </td>
            <td>
              <input type="text" name="entertainmentStatus" size="18"></input>
            </td>
            <td>
              <input type="submit" value="Update Status" name="updateEntertainment"></input>
              <input type="submit" value="Display" name="displayEntertainment"></input>
            </td>
          </form>
        </tr>
      </table>
    </div>
    <!-- todo -->
  </div>
  <hr>
  <!-- repairs management -->
  <div id="repairsManagement" class="content-wrap">
    <h1>Repair Management</h1>
    <p>Display current repairs record:</p>
    <form method="POST" action="adminSystem.php">
      <p><input type="submit" value="Display" name="displayRepairs"></input></p>
    </form>
    <!-- todo -->
    <p>Add repair record:</p>
    <div class="tableWrap">
      <table>
        <tr>
          <th> Facility Name
          </th>
          <th>Attraction Name
          </th>
          <th>Repair Date
          </th>
          <th>Action
          </th>
        </tr>
        <tr>
          <form method="POST" action="adminSystem.php">
            <td>
              <select name="repairFacility" class="form-control form-control-sm">
                <?php
                $resultSelection = executeSQL("select name from MAINTENANCEFACILITY");
                while ($rs = OCI_Fetch_Assoc($resultSelection)) {
                  foreach ($rs as $option) {
                    echo "<option>$option</option>\n";
                  }
                } ?>


              </select>
            </td>
            <td>
              <select name="repairAttraction" class="form-contral form-control-sm">
                <?php
                $resultSelection = executeSQL("select att_name from ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1");
                while ($rs = OCI_Fetch_Assoc($resultSelection)) {
                  foreach ($rs as $option) {
                    echo "<option>$option</option>\n\n";
                  }
                } ?>

              </select>
            </td>
            <td>
              <input type="text" name="repairDate" size="15"></input>
            </td>
            <td>
              <input type="submit" value="Submit" name="submitRepair"></input>
            </td>
          </form>
        </tr>
      </table>
    </div>
    <p>Attractions have been repaired by all maintenance facilities (replacement is needed):</p>
    <form method='POST' action="adminSystem.php">
      <p><input type="submit" value="Display" name="displayReplacementNeeded"></p>
    </form>
    <!-- todo division part -->
  </div>
</div>
<div class = "table-Display">
  <h1 class = "title">Your Info will be displayed here</h1>
  <div class="tableWrap">
    <?php

    if (array_key_exists('displayadmininfo', $_GET)) {
      $result = executeSQL("select * from administrator2");
      $columnNames = array("Duty Area", "Contact Info");

    }

    else if (array_key_exists('findFacility', $_GET)) {
      $facility = $_GET['facilityName'];
      $result = executeSQL("select * from MAINTENANCEFACILITY where name='$facility'");
      $columnNames = array("Name", "Contact Info");

    }

    else if (array_key_exists('findGuardian',$_POST)) {
      $gid = $_POST['groupID'];
      $name = $_POST['visitorName'];
      $exist = ifExist($name, 'yname', 'young');
      if ($exist) {
        $result = executeSQL("select YOUNGVISITOR_INCLUDE_ISGURADEDBY.YOUNGVISITORNAME, contact_info
          from ADULTVISITOR_INCLUDE inner join YOUNGVISITOR_INCLUDE_ISGURADEDBY on
          ADULTVISITOR_INCLUDE.VISITORNAME=YOUNGVISITOR_INCLUDE_ISGURADEDBY.ADULTVISITORNAME
          where YOUNGVISITOR_INCLUDE_ISGURADEDBY.YOUNGGROUPID='$gid'
          and YOUNGVISITOR_INCLUDE_ISGURADEDBY.YOUNGVISITORNAME='$name'");
        $columnNames = array("Visitor Name", "Guardian Contact Info");
      } else {
        echo "Cannot find the record of this visitor!";
      }

    }

    else if (array_key_exists('findContactInfo', $_POST)) {
      $gid = $_POST['groupID'];
      $name = $_POST['visitorName'];
      $exist = ifExist($name, 'aname', 'adult');
      if ($exist) {
        $result = executeSQL("select VISITORNAME, contact_info from ADULTVISITOR_INCLUDE where GROUPID='$gid' and VISITORNAME='$name'");
        $columnNames = array("Visitor Name", "Contact Info");
      } else {
        echo "Cannot find the record of this visitor!";
      }

    }

    else if (array_key_exists('updateAttraction', $_POST)) {
      $attStatus = $_POST['attractionStatus'];
      $attName = $_POST['attractionName'];
      executeSQL("update ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1 set status='$attStatus' where att_name='$attName'");
      OCICommit($db_conn);
      echo "Updated successfully";
      $columnNames = array("Name","Location","Capacity","Status","Open Time", "Close Time","Admin ID");
      $result = executeSQL("select * from ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1");
    }

    else if (array_key_exists('displayAttr', $_POST)) {
      $columnNames = array("Name","Location","Capacity","Status","Open Time", "Close Time","Admin ID");
      $result = executeSQL("select * from ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1");
    }

    else if (array_key_exists('displayReservation', $_POST)) {
      $columnNames = array("Name","Perform Time", "#Reservation");
      $result = executeSQL("select ENTERTAINMENTNAME, perform_time, count(*) from RESERVATION_LINKEDTO_MANAGEDBY group by ENTERTAINMENTNAME, perform_time");
    }

    else if (array_key_exists('updateEntertainment', $_POST)) {
      $entStatus = $_POST['entertainmentStatus'];
      $entName = $_POST['entertainmentName'];
      $performTime = $_POST['performTime'];
      $exist = ifExist2($entName, $performTime, 'name', 'perform_time','ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1');
      if ($exist) {
        $columnNames = array("Name", "Perform Time", "Status");
        executeSQL("update ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1 set status='$entStatus'
          where name='$entName' and perform_time='$performTime'");
        OCICommit($db_conn);
        echo "Updated successfully";
        $result = executeSQL("select * from ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1");
      } else {
        echo "Cannot find the record";
      }


    }

    else if (array_key_exists('displayEntertainment', $_POST)){
      $columnNames = array("Name", "Perform Time", "Status");
      $result = executeSQL("select * from ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1");
    }

    else if (array_key_exists('displayRepairs', $_POST)) {
      $columnNames = array("Maintenance Facility Name", "Attraction Name", "Date");
      $result = executeSQL("select * from repair");
    }

    else if (array_key_exists('submitRepair', $_POST)) {
      $columnNames = array("Maintenance Facility Name", "Attraction Name", "Date");
      $facility = $_POST['repairFacility'];
      $rAttr = $_POST['repairAttraction'];
      $latestRDate = $_POST['repairDate'];
      $exist = ifExist2($facility, $rAttr, 'mf_name','att_name','repair');
      if ($exist) {
        executeSQL("update repair set REPAIRE_DATE=to_date('$latestRDate','YYYY-MM-DD') where mf_name = '$facility' and att_name = '$rAttr'");
        echo "Updated successfully";
        OCICommit($db_conn);
      } else {
        executeSQL("insert into repair values('$facility','$rAttr',to_date('$latestRDate','YYYY-MM-DD'))");
        echo "Inserted successfully";
        OCICommit($db_conn);
      }

      $result = executeSQL("select * from repair");
    }

    else if (array_key_exists('displayReplacementNeeded', $_POST)) {
      $result = executeSQL("select distinct r.att_name
        from repair r
        where not exists
        (select * from MAINTENANCEFACILITY f
        where not exists
        (select r2.mf_name from repair r2
        where r.att_name = r2.att_name and f.name = r2.mf_name))
        group by r.att_name");
      if (OCI_Fetch_Assoc($result)) {
        $columnNames = array("Attraction Name");
        echo "Find attraction need replacement!";
        $result = executeSQL("select distinct r.att_name
          from repair r
          where not exists
          (select * from MAINTENANCEFACILITY f
          where not exists
          (select r2.mf_name from repair r2
          where r.att_name = r2.att_name and f.name = r2.mf_name))
          group by r.att_name");
      } else {
        echo "Have no attraction need replacement";
      }

    }
    printTable($result, $columnNames);


    ?>
  </div>
</div>

</div>
</body>

</html>
