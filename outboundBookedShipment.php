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
include 'companyProcess.php';
$companyProcess=new companyProcess();
include 'outboundShipmentProcess.php';
$outboundShipmentProcess=new outboundShipmentProcess();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/ddac.css" rel="stylesheet" type="text/css" />
        <title>Outbound Booked Shipment Page</title>
        <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script type="text/javascript">
            function updateShippingRequestPop(tis)
            {
                document.getElementById('updateShippingRequestPopBox').style.display = "block";
                var id = document.getElementById(tis.id).id;
                $('input#shipmentId').val(id);
                
                $.post('outboundBookedShipmentJQuery.php',{id1:id},function(data){
                    $('input#updateName').val(data);
                });
                $.post('outboundBookedShipmentJQuery.php',{id2:id},function(data){
                    $('#updateDestination').html(data);
                });
                $.post('outboundBookedShipmentJQuery.php',{id3:id},function(data){
                    $('#updateContainer').html(data);
                });
                $.post('outboundBookedShipmentJQuery.php',{id4:id},function(data){
                    $('input#updateCreateDate').val(data);
                });
                $.post('outboundBookedShipmentJQuery.php',{id5:id},function(data){
                    $('input#updateCreateTime').val(data);
                });
                $.post('outboundBookedShipmentJQuery.php',{id6:id},function(data){
                    $('#updateYard').html(data);
                });
            }
            
            function closeUpdateShippingRequestPop()
            {
                document.getElementById('updateShippingRequestPopBox').style.display = "none";
            }
            
            function displayYard()
            {
                var destination = document.getElementById('updateDestination').value;
                var container = document.getElementById('updateDestination').value;
                var capacity=0;
                if(destination=="" || container=="")
                {
                    if(container=="3m*3m Container")
                    {
                        capacity=9;
                    }else if(container=="5m*5m Container"){
                        capacity=25;
                    }else if(container=="7m*7m Container"){
                        capacity=49;
                    }
                    $.post('outboundBookedShipmentJQuery.php',{destination1:destination,container1:capacity},function(data){
                        $('#updateYard').html(data);
                    });
                }else{
                    if(container=="3m*3m Container")
                    {
                        capacity=9;
                    }else if(container=="5m*5m Container"){
                        capacity=25;
                    }else if(container=="7m*7m Container"){
                        capacity=49;
                    }
                    $.post('outboundBookedShipmentJQuery.php',{destination:destination,container:capacity},function(data){
                        $('#updateYard').html(data);
                    });
                }
            }
            
            function removeShippingRequestPop(tis)
            {
                document.getElementById('removeShippingRequestPopBox').style.display = "block";
                var id=document.getElementById(tis.id).id;
                $('input#removeShipmentId').val(id);
            }
            
            function closeRemoveShippingRequestPop()
            {
                document.getElementById('removeShippingRequestPopBox').style.display = "none";
            }
            
            function confirmShippingRequestPop(tis)
            {
                document.getElementById('confirmShippingRequestPopBox').style.display = "block";
                var id=document.getElementById(tis.id).id;
                $('input#confirmShipmentId').val(id);
            }
            
            function closeConfirmShippingRequestPop()
            {
                document.getElementById('confirmShippingRequestPopBox').style.display = "none";
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
                    <li class="linkactive"><a href="outboundBookingShipment.php">Outbound</a></li>
                    <li><a href="inboundWaitingShipment.php">Inbound</a></li>
                    <li><a href="yard.php">Yard</a></li>
                </ul>
            </div>

            <br>
            
            <p style="margin-left:3%;font-size:18px"><b><a href="outboundBookingShipment.php">Booking</a> | <a href="outboundBookedShipment.php">Booked </a>| <a href="outboundConfirmedShipment.php">Confirm</a></b></p>
            
            <div id="updateShippingRequestPopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeUpdateShippingRequestPop()" value="X">
                <h2 style="margin-left:10%">Update Booked Shipment</h2>
                <table align="center" width="90%" height="90%">
                    <input id="shipmentId" type="hidden" size="20" name="shipmentId">
                    <tr>
                        <td align="right" width="25%" height="12%">Company:</td>
                        <td width="60%">
                            <input id="updateName" type="text" size="30" name="updateName">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="12%">Destination:</td>
                        <td width="60%">
                            <select id="updateDestination" name="updateDestination" onchange="displayYard();">
                                <option value="">Select Destination</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="12%">Container:</td>
                        <td width="60%">
                            <select id="updateContainer" name="updateContainer" onchange="displayYard();">
                                <option value="">Select Container</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="12%">Create Date:</td>
                        <td width="60%">
                            <input id="updateCreateDate" type="text" size="40" name="updateCreateDate" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Create Time:</td>
                        <td><input id="updateCreateTime" type="text" size="40" name="updateCreateTime" readonly></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Yard:</td>
                        <td>
                            <select id="updateYard" name="updateYard">
                                <option value="">Select Yard</option>
                            </select>
                            
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="submit" name="updateShipment" value="Update"></td>
                    </tr>
                </table>
            </div>
            
            <div id="removeShippingRequestPopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeRemoveShippingRequestPop()" value="X">
                <h3 style="margin-left:10%">Are You Confirm To Cancel This Shipment?</h3>
                <input id="removeShipmentId" type="hidden" size="40" name="removeShipmentId">
                <p align="center"><input type="submit" name="removeShipment" value="Remove"></p>
            </div>
            
            <div id="confirmShippingRequestPopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeConfirmShippingRequestPop()" value="X">
                <h3 style="margin-left:10%">Are You Confirm To Ship This Shipment?</h3>
                <input id="confirmShipmentId" type="hidden" size="40" name="confirmShipmentId">
                <p align="center"><input type="submit" name="confirmShipment" value="Confirm"></p>
            </div>
            
            <p style="margin-left:3%;color:red">
            <?php
                if(isset($_POST['updateShipment']))
                {
                    if($_POST['updateName']==null || $_POST['updateDestination']==null || $_POST['updateContainer']==null  || $_POST['updateCreateDate']==null || $_POST['updateCreateTime']==null || $_POST['updateYard']==null)
                    {
                        echo "Please Fill Up All Information!";
                        echo "<br>";
                    }else{
                        $id=trim($_POST['shipmentId']);
                        $name=trim($_POST['updateName']);
                        $destination=trim($_POST['updateDestination']);
                        $container=trim($_POST['updateContainer']);
                        $createDate=trim($_POST['updateCreateDate']);
                        $createTime=trim($_POST['updateCreateTime']);
                        $yard=trim($_POST['updateYard']);

                        echo $outboundShipmentProcess->updateShipment($id,$name,$destination,$container,$createDate,$createTime,$yard);
                        echo "<br>";
                    }
                }else if(isset($_POST['removeShipment'])){
                    $id=trim($_POST['removeShipmentId']);
                    echo $outboundShipmentProcess->removeShipment($id);
                    echo "<br>";
                }else if(isset($_POST['confirmShipment'])){
                    $id=trim($_POST['confirmShipmentId']);
                    echo $outboundShipmentProcess->confirmShipment($id);
                    echo "<br>";
                }
                echo $outboundShipmentProcess->displayOutboundBookedShipment();
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
