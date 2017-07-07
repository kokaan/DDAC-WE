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
include 'selectOption.php';
$selectOption=new selectOption();
$d=date("Y-m-d");
$d1=date("Y-m-d", strtotime("+1 days"));
$d2=date("Y-m-d", strtotime("+2 days"));
$d3=date("Y-m-d", strtotime("+3 days"));
$d4=date("Y-m-d", strtotime("+4 days"));
$d5=date("Y-m-d", strtotime("+5 days"));
$time1=10;
$time2=10;
$time3=":00:00";
$date=array();
array_push($date,$d1);
array_push($date,$d2);
array_push($date,$d3);
array_push($date,$d4);
array_push($date,$d5);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/ddac.css" rel="stylesheet" type="text/css" />
        <title>Outbound Booking Shipment Page</title>
        <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script type="text/javascript">
            function addShippingRequestPop(tis)
            {
                document.getElementById('addShippingRequestPopBox').style.display = "block";
                var id = document.getElementById(tis.id).id;
                $.post('outboundBookingShipmentJQuery.php',{id1:id},function(data){
                    $('input#createDate').val(data);
                });
                $.post('outboundBookingShipmentJQuery.php',{id2:id},function(data){
                    $('input#createTime').val(data);
                });
                //$('input#shipmentId').val(id);
            }
            
            function closeAddShippingRequestPop()
            {
                document.getElementById('addShippingRequestPopBox').style.display = "none";
            }
            
            function displayYard()
            {
                var destination = document.getElementById('destination').value;
                var container = document.getElementById('container').value;
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
                    $.post('outboundBookingShipmentJQuery.php',{destination1:destination,container1:capacity},function(data){
                        $('#yard').html(data);
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
                    $.post('outboundBookingShipmentJQuery.php',{destination:destination,container:capacity},function(data){
                        $('#yard').html(data);
                    });
                }
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
            
            <div id="addShippingRequestPopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeAddShippingRequestPop()" value="X">
                <h2 style="margin-left:10%">Request/Book Shipment</h2>
                <table align="center" width="90%" height="90%">
                    <!--<input id="shipmentId" type="text" size="20" name="shipmentId">-->
                    <tr>
                        <td align="right" width="25%" height="12%">Company:</td>
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
                        <td align="right" width="25%" height="12%">Destination:</td>
                        <td width="60%">
                            <select id="destination" name="destination" onchange="displayYard();">
                                <option value="">Select Destination</option>
                                <?php
                                    $result=$selectOption->getDistinctDestination();
                                    while($real_result= mysqli_fetch_array($result)) {
                                        echo "<option value=\"{$real_result['destination']}\">";
                                        echo $real_result['destination'];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="12%">Container:</td>
                        <td width="60%">
                            <select id="container" name="container" onchange="displayYard();">
                                <option value="">Select Container Size</option>
                                <option value="3m*3m Container">3m*3m Container</option>
                                <option value="5m*5m Container">5m*5m Container</option>
                                <option value="7m*7m Container">7m*7m Container</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="25%" height="12%">Create Date:</td>
                        <td width="60%">
                            <input id="createDate" type="text" size="40" name="createDate" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Create Time:</td>
                        <td><input id="createTime" type="text" size="40" name="createTime" readonly></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Yard:</td>
                        <td>
                            <select id="yard" name="yard">
                                <option value="">Select Yard</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="submit" name="bookShipment" value="Book"></td>
                    </tr>
                </table>
            </div>
            
            <p style="margin-left:3%;color:red">
            <?php
                if(isset($_POST['bookShipment']))
                {
                    if($_POST['name']==null || $_POST['destination']==null || $_POST['container']==null  || $_POST['createDate']==null || $_POST['createTime']==null || $_POST['yard']==null)
                    {
                        echo "Please Fill Up All Information!";
                        echo "<br>";
                    }else{

                        $name=trim($_POST['name']);
                        $destination=trim($_POST['destination']);
                        $container=trim($_POST['container']);
                        $createDate=trim($_POST['createDate']);
                        $createTime=trim($_POST['createTime']);
                        $yard=trim($_POST['yard']);
                        
                        echo $outboundShipmentProcess->bookShipment($name,$destination,$container,$createDate,$createTime,$yard);
                        echo "<br>";
                    }
                }
                
                echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Request/Book Shipment"."</h2>";
                echo "<table id=\"table-v1\" align=\"center\" width=\"95%\" height=\"95%\">";
                echo "<tr>";
                echo "<th>"."Date/Time"."</th>";
                for ($i=0;$i<5;$i++)
                {
                    $time4=$time2.$time3;
                    echo "<th align=\"center\">".$time4."</th>";
                    $time2+=2;
                }
                echo "</tr>";
                
                //Convert to datetime
                //$startdateD = date_create_from_format('Y-m-d', $d);
                //$strStartDate2=$d;
                foreach($date as $value)
                {
                    echo "<tr>";
                    echo "<td align=\"center\">".$value."</td>";
                    
                    //$enddateD2=date_add($startdateD,date_interval_create_from_date_string("1 days"));
                    //$strEndDateD2 = $enddateD2->format('Y-m-d');
                    
                    for($i=0;$i<5;$i++)
                    {
                        $time5=$time1.$time3;
                        $result=$outboundShipmentProcess->displaySchedule($value,$time5);
                        $real_result=mysqli_fetch_array($result);
                        
                        if($real_result['id']==null)
                        {
                            echo "<td height=\"40px\" align=\"center\" >"."NOT AVAILABLE"."</td>";
                        }else{
                            echo "<td align=\"center\">"."<input id={$real_result['id']} style=\"width:90px;height:25px;cursor:pointer;\" type=\"button\" value=\"BOOK\" onclick=\"addShippingRequestPop(this)\">"."</td>";
                        }
                        $time1+=2;
                    }
                    echo "</tr>";
                    $time1=10; 
                    //$strStartDate2=$strEndDateD2;
                    //$startdateD = date_create_from_format('Y-m-d', $strStartDate2);
                }
                echo "</table>";
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
