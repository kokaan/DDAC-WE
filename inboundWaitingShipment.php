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
include 'inboundShipmentProcess.php';
$inboundShipmentProcess=new inboundShipmentProcess();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/ddac.css" rel="stylesheet" type="text/css" />
        <title>Inbound Waiting Shipment Page</title>
        <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script type="text/javascript">
            function updateShippingVehiclePop(tis)
            {
                document.getElementById('updateShippingVehiclePopBox').style.display = "block";
                var id = document.getElementById(tis.id).id;
                $('input#shipmentId').val(id);
                
                $.post('inboundWaitingShipmentJQuery.php',{id1:id},function(data){
                    $('input#updateName').val(data);
                    updateShippingVehicle();
                });
                $.post('inboundWaitingShipmentJQuery.php',{id2:id},function(data){
                    $('input#updateDestination').val(data);
                });
                $.post('inboundWaitingShipmentJQuery.php',{id3:id},function(data){
                    $('input#updateContainer').val(data);
                });
                $.post('inboundWaitingShipmentJQuery.php',{id4:id},function(data){
                    $('input#updateCreateDate').val(data);
                });
                $.post('inboundWaitingShipmentJQuery.php',{id5:id},function(data){
                    $('input#updateCreateTime').val(data);
                });
                $.post('inboundWaitingShipmentJQuery.php',{id6:id},function(data){
                    $('input#updateYard').val(data);
                });
            }
            
            function updateShippingVehicle()
            {
                var name=document.getElementById('updateName').value;
                $.post('inboundWaitingShipmentJQuery.php',{name:name},function(data){
                    $('#updateVehicle').html(data);
                });
            }
            
            function closeUpdateShippingVehiclePop()
            {
                document.getElementById('updateShippingVehiclePopBox').style.display = "none";
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
                    <li><a href="vehicle.php">Vehicle</a></li>
                    <li><a href="outboundBookingShipment.php">Outbound</a></li>
                    <li class="linkactive"><a href="inboundWaitingShipment.php">Inbound</a></li>
                    <li><a href="yard.php">Yard</a></li>
                </ul>
            </div>

            <br>
            
            <p style="margin-left:3%;font-size:18px"><b><a href="inboundWaitingShipment.php">Not Managed</a> | <a href="inboundCompletedShipment.php">Managed</a></b></p>
            
            <div id="updateShippingVehiclePopBox" style="display:none">
                <input id="closepopp" type="button" onclick="closeUpdateShippingVehiclePop()" value="X">
                <h2 style="margin-left:10%">Arrange Vehicle</h2>
                <table align="center" width="90%" height="90%">
                    <input id="shipmentId" type="hidden" size="20" name="shipmentId">
                    <tr>
                        <td align="right" width="25%" height="10%">Company:</td>
                        <td width="60%">
                            <input id="updateName" type="text" size="30" name="updateName">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="10%">Destination:</td>
                        <td width="60%">
                            <input id="updateDestination" type="text" size="30" name="updateDestination">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="10%">Container:</td>
                        <td width="60%">
                            <input id="updateContainer" type="text" size="30" name="updateContainer">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="10%">Create Date:</td>
                        <td width="60%">
                            <input id="updateCreateDate" type="text" size="30" name="updateCreateDate" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="10%">Create Time:</td>
                        <td><input id="updateCreateTime" type="text" size="30" name="updateCreateTime" readonly></td>
                    </tr>
                    <tr>
                        <td align="right" height="10%">Yard:</td>
                        <td>
                            <input id="updateYard" type="text" size="30" name="updateYard">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="10%">Vehicle:</td>
                        <td>
                            <select id="updateVehicle" name="updateVehicle">
                                <option value="">Select Vehicle</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="submit" name="updateShipmentVehicle" value="Update"></td>
                    </tr>
                </table>
            </div>
            
            <p style="margin-left:3%;color:red">
            <?php
                if(isset($_POST['updateShipmentVehicle']))
                {
                    if($_POST['updateVehicle']==null)
                    {
                        echo "Please Fill Up All Information!";
                        echo "<br>";
                    }else{
                        $id=trim($_POST['shipmentId']);
                        $vehicle=trim($_POST['updateVehicle']);

                        echo $inboundShipmentProcess->updateShipmentVehicle($id,$vehicle);
                        echo "<br>";
                    }
                }
                echo $inboundShipmentProcess->displayInboundWaitingShipment();
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

