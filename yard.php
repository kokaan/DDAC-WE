<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

include 'yardProcess.php';
$yardProcess=new yardProcess();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/ddac.css" rel="stylesheet" type="text/css" />
        <title>Yard Page</title>
        <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script type="text/javascript">
       
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
                    <li><a href="inboundWaitingShipment.php">Inbound</a></li>
                    <li class="linkactive"><a href="yard.php">Yard</a></li>
                </ul>
            </div>

            <br>
            <?php
                echo $yardProcess->displayYard();
            ?>
              
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
