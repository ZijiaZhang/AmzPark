<html lang="en"><head>
    <meta charset="UTF-8">
    <title> Amz Park</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<?php
//include_once '../login.php';
include '../session.php';
include '../database.php';
initializeSession();
#print_r($_SESSION);

if(checkSession()){
        //header('location: ./account');
    echo "Your Session ID: ";
    var_dump(session_id());
    $name = $_SESSION['login_user'];
}else{
    header('location: ../login');
}
?>


<?php
//var_dump($_POST);
if(isset($_POST['submit'])){
    if($_POST['submit']== 'delete_plan'){
        $planname = $_POST['del_plan'];
        try{
            executeSQL("DELETE FROM madeBy where groupID = '$name' and PLANNUMBER = '$planname'");
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else if($_POST['submit'] == 'addToPlan'){
        $pname = $_POST['add_to_plan'];
        $aname = $_POST['addedAtt'];
        try{
            insertIntoOfVisiting($pname, $aname);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else if($_POST['submit'] == 'delFromPlan'){
        $pname = $_POST['del_from_plan'];
        $aname = $_POST['delAtt'];
        try{
            executeSQL("DELETE FROM ofVisiting where PLANNUMBER = '$pname' and ATTNAME = '$aname'");
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>


<div id = "modify_add">
    <button id="adultPanelButton" onclick="ToggleForm()">Add Attraction To A Plan</button>
    <div class="popup" id="AddAttform">
        <form action="" class="form-container" method = "post">
            <h1>ADD Attraction</h1>
            <table>
                <tr>
                    <td>
                        <label for="pname"><b>Plan Name</b></label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Plan Name" name="add_to_plan" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="aname"><b>Attraction Name</b></label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Attraction Name" name="addedAtt" required>
                    </td>
                </tr>
            </table>
            <button type="submit" class="" name = "submit" value = 'addToPlan'>Add</button>
            <button type="button" class="" onclick="closeForm()">Close</button>
        </form>
    </div>
</div>

<div id = "modify_delete">
    <button id="adultPanelButton" onclick="ToggleForm2()">Delete Attraction From A Plan</button>
    <div class="popup" id="DeleteAttform">
        <form action="" class="form-container" method = "post">
            <h1>Delete Attraction</h1>
            <table>
                <tr>
                    <td>
                        <label for="pname"><b>Plan Name</b></label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Plan Name" name="del_from_plan" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="anamet"><b>Attraction Name</b></label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Attraction Name" name="delAtt" required>
                    </td>
                </tr>
            </table>
            <button type="submit" class="" name = "submit" value = 'delFromPlan'>Delete</button>
            <button type="button" class="" onclick="closeForm()">Close</button>
        </form>
    </div>
</div>






<section id = "Mine" >
    <div class="simple-chord--wrapper component-wrapper" style="background-color: rgba(100,100,100,0.3);">
        <head>
            <title>My Plans</title>
        </head>
        <body>
            <table>
                <thead>
                    <tr>
                        <td>Plan Name</td>
                        <td>Attractions in this plan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try{
                        $results = executeSQL("SELECT B.PLANNUMBER, LISTAGG(B.ATTNAME, ',') WITHIN GROUP (ORDER BY B.ATTNAME) FROM ofVisiting B, madeby A WHERE A.PLANNUMBER = B.PLANNUMBER AND A.groupID='$name' GROUP BY B.PLANNUMBER" );
                    }catch ( Exception $e){
                        echo $e->getMessage();
                    }
         //   echo "OK";
                    while($row =  OCI_Fetch_Array($results)) {
                        ?>
                        <form action = "" method = "post">
                            <tr>
                                <td><input type = "hidden" name = "del_plan" value = <?php echo "'".$row['PLANNUMBER']."'";?> > <?php echo $row['PLANNUMBER'];?></td>
                                <td><?php echo $row[1];?></td>
                                <td><button type="submit" value = "delete_plan" name = "submit">Delete</button></td>
                            </tr>
                        </form>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </body>
    </div>

</section>

<a href="../myaccount"><button>GO BACK To Previous Page</button> </a>


<script>
    function ToggleForm() {
        if(document.getElementById("adultAddform").style.display == "block"){
            document.getElementById("adultAddform").style.display = "none";
            document.getElementById("adultPanelButton").InnerHTML = "Add attraction to a Plan";
        }
        else{
            document.getElementById("adultAddform").style.display = "block";
            document.getElementById("adultPanelButton").InnerHTML = "Close Window";
        }
    }

    function ToggleForm2() {
        if(document.getElementById("adultAddform").style.display == "block"){
            document.getElementById("adultAddform").style.display = "none";
            document.getElementById("adultPanelButton").InnerHTML = "Delete attraction from a plan";
        }
        else{
            document.getElementById("adultAddform").style.display = "block";
            document.getElementById("adultPanelButton").InnerHTML = "Close Window";
        }
    }



    function closeForm() {
        document.getElementById("adultAddform").style.display = "none";
    }
</script>



</html>