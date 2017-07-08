<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
/*
    The following source code to pass data through jQuery without refreshing the page is obtained from (Agarwal, n.d.)
    The reference is provided in the documentation.
*/
include 'vehicleProcess.php';
include 'companyProcess.php';
$vehicleProcess=new vehicleProcess();
$companyProcess=new companyProcess();
$num=0;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/ddac.css" rel="stylesheet" type="text/css" />
        <title>Vehicle Page</title>
        <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script type="text/javascript">
            function addVehiclePop()
            {
                document.getElementById('addVehiclePopBox').style.display = "block";
            }
            
            function closeAddVehiclePop()
            {
                document.getElementById('addVehiclePopBox').style.display = "none";
            }
            
            function updateVehiclePop(tis)
            {
                document.getElementById('updateVehiclePopBox').style.display = "block";
                var id = document.getElementById(tis.id).id;
                $('input#updateId').val(id);
                $.post('vehicleJQuery.php',{id1:id},function(data){
                        //$('input#testing').val(data);
                        $('input#updateName').val(data);
                });
                $.post('vehicleJQuery.php',{id2:id},function(data){
                        $('input#updateNumberPlate').val(data);
                });
            }
            
            function closeUpdateVehiclePop()
            {
                document.getElementById('updateVehiclePopBox').style.display = "none";
            }
            
            function removeVehiclePop(tis)
            {
                document.getElementById('removeVehiclePopBox').style.display = "block";
                var id=document.getElementById(tis.id).id;
                $('input#removeId').val(id);
            }
            
            function closeRemoveVehiclePop()
            {
                document.getElementById('removeVehiclePopBox').style.display = "none";
            }
            
        </script>
    </head>
    <body id="autostyle">
        <form method="POST">
            <div style="background-color:#FFFFFF">

            <div>
                <a href=""><img src="Image/logo.png" width="250px" height="auto"></a>
                <a href="/.auth/logout" style="float:right;font-size:20px;margin-right:1%">Logout</a>
            </div>      

            <div id="navigationmenu" style="height: 30px">
                <ul>
                    <li><a href="company.php">Company</a></li>
                    <li class="linkactive"><a href="vehicle.php">Vehicle</a></li>
                    <li><a href="outboundBookingShipment.php">Outbound</a></li>
                    <li><a href="inboundWaitingShipment.php">Inbound</a></li>
                    <li><a href="yard.php">Yard</a></li>
                </ul>
            </div>

            <br>
            <div id="addVehiclePopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeAddVehiclePop()" value="X">
                <h2 style="margin-left:10%">New Vehicle Registration</h2>
                <table align="center" width="90%" height="90%">
                    <tr>
                        <td align="right" width="25%" height="17%">Company:</td>
                        <td width="60%">
                            <select name="name">
                                <option value="">Select Company</option>
                                <?php
                                    $result=$companyProcess->getDistinctCompany();
                                    while($real_result= mysqli_fetch_array($result)) {
                                        echo "<option value=\"{$real_result['name']}\">";
                                        echo $real_result['name'];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="17%">Number Plate:</td>
                        <td><input type="text" size="20" name="numberPlate"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="submit" name="addVehicle" value="Add"></td>
                    </tr>
                </table>
            </div>
            
            <div id="updateVehiclePopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeUpdateVehiclePop()" value="X">
                <h2 style="margin-left:10%">Update Vehicle Information</h2>
                <table align="center" width="90%" height="90%">
                    <input id="updateId" type="hidden" size="20" name="updateId">
                    <tr>
                        <td align="right" width="25%" height="12%">Company Name:</td>
                        <td width="60%">
                            <input id="updateName" type="text" size="40" name="updateName" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Number Plate:</td>
                        <td><input id="updateNumberPlate" type="text" size="40" name="updateNumberPlate"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="submit" name="updateVehicle" value="Update"></td>
                    </tr>
                </table>
            </div>
            
            <div id="removeVehiclePopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeRemoveVehiclePop()" value="X">
                <h3 style="margin-left:10%">Are You Confirm To Remove The Selected Registered Vehicle? </h3>
                <input id="removeId" type="hidden" size="40" name="removeId">
                <p align="center"><input type="submit" name="removeVehicle" value="Remove"></p>
            </div>
            
            
            <p style="margin-left:3%;color:red">
            <?php
                if(isset($_POST['addVehicle']))
                {
                    if($_POST['name']==null || $_POST['numberPlate']==null)
                    {
                        echo "Please Fill Up All Information!";
                        echo "<br>";
                    }else{

                        $name=trim($_POST['name']);
                        $numberPlate=trim($_POST['numberPlate']);

                        echo $vehicleProcess->addVehicle($name,$numberPlate);
                        echo "<br>";
                    }
                }else if(isset($_POST['updateVehicle'])){
                    if($_POST['updateNumberPlate']==null)
                    {
                        echo "Please Fill Up All Information!";
                        echo "<br>";
                    }else{
                        $id=trim($_POST['updateId']);
                        $name=trim($_POST['updateName']);
                        $numberPlate=trim($_POST['updateNumberPlate']);

                        echo $vehicleProcess->updateVehicle($id,$name,$numberPlate);
                        echo "<br>";
                    }
                }else if(isset($_POST['removeVehicle'])){
                    $id=trim($_POST['removeId']);
                    echo $vehicleProcess->removeVehicle($id);
                    echo "<br>";
                }
                
                echo $vehicleProcess->displayVehicle();
            ?>
            </p>
                
            <br>
            <hr/>

            <div>
            <p style="font-size:16px;color:#666666; ">This is West Europe Version</p>  
            <p style="font-size:10px;color:#666666; ">© 2017 Maersk Group. All rights reserved.</p>
            </div>
            <br>

            </div>
        </form>    
        
        <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
    </body>
</html>
