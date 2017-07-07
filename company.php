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

$num=0;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/ddac.css" rel="stylesheet" type="text/css" />
        <title>Company Page</title>
        <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script type="text/javascript">
            function addCompanyPop()
            {
                document.getElementById('addCompanyPopBox').style.display = "block";
            }
            
            function closeAddCompanyPop()
            {
                document.getElementById('addCompanyPopBox').style.display = "none";
            }
            
            function updateCompanyPop(tis)
            {
                document.getElementById('updateCompanyPopBox').style.display = "block";
                var id = document.getElementById(tis.id).id;
                $('input#updateId').val(id);
                $.post('companyJQuery.php',{id1:id},function(data){
                        //$('input#testing').val(data);
                        $('input#updateName').val(data);
                });
                $.post('companyJQuery.php',{id2:id},function(data){
                        $('input#updateAddress').val(data);
                });
                $.post('companyJQuery.php',{id3:id},function(data){
                        $('input#updateContact1').val(data);
                });
                $.post('companyJQuery.php',{id4:id},function(data){
                        $('input#updateContact2').val(data);
                });
                $.post('companyJQuery.php',{id5:id},function(data){
                        $('input#updateEmail1').val(data);
                });
                $.post('companyJQuery.php',{id6:id},function(data){
                        $('input#updateEmail2').val(data);
                });
            }
            
            function closeUpdateCompanyPop()
            {
                document.getElementById('updateCompanyPopBox').style.display = "none";
            }
            
            function removeCompanyPop(tis)
            {
                document.getElementById('removeCompanyPopBox').style.display = "block";
                var id=document.getElementById(tis.id).id;
                $('input#removeId').val(id);
            }
            
            function closeRemoveCompanyPop()
            {
                document.getElementById('removeCompanyPopBox').style.display = "none";
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
                    <li class="linkactive"><a href="company.php">Company</a></li>
                    <li><a href="vehicle.php">Vehicle</a></li>
                    <li><a href="outboundBookingShipment.php">Outbound</a></li>
                    <li><a href="inboundWaitingShipment.php">Inbound</a></li>
                    <li><a href="yard.php">Yard</a></li>
                </ul>
            </div>

            <br>
            <div id="addCompanyPopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeAddCompanyPop()" value="X">
                <h2 style="margin-left:10%">New Company Registration</h2>
                <table align="center" width="90%" height="90%">
                    <tr>
                        <td align="right" width="25%" height="12%">Name:</td>
                        <td width="60%">
                            <input type="text" size="40" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Address:</td>
                        <td><input type="text" size="40" name="address"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Contact Number 1:</td>
                        <td><input type="text" size="20" name="contact1" pattern=".*\d" title="Digit Only"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Contact Number 2:</td>
                        <td><input type="text" size="20" name="contact2" pattern=".*\d" title="Digit Only"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Email 1:</td>
                        <td><input type="email" size="20" name="email1"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Email 2:</td>
                        <td><input type="email" size="20" name="email2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="submit" name="addCompany" value="Add"></td>
                    </tr>
                </table>
            </div>
            
            <div id="updateCompanyPopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeUpdateCompanyPop()" value="X">
                <h2 style="margin-left:10%">Update Company Information</h2>
                <table align="center" width="90%" height="90%">
                    <input id="updateId" type="hidden" size="20" name="updateId">
                    <tr>
                        <td align="right" width="25%" height="12%">Name:</td>
                        <td width="60%">
                            <input id="updateName" type="text" size="40" name="updateName" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Address:</td>
                        <td><input id="updateAddress" type="text" size="40" name="updateAddress"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Contact Number 1:</td>
                        <td><input id="updateContact1" type="text" size="20" name="updateContact1" pattern=".*\d" title="Digit Only"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Contact Number 2:</td>
                        <td><input id="updateContact2" type="text" size="20" name="updateContact2" pattern=".*\d" title="Digit Only"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Email 1:</td>
                        <td><input id="updateEmail1" type="email" size="20" name="updateEmail1"></td>
                    </tr>
                    <tr>
                        <td align="right" height="12%">Email 2:</td>
                        <td><input id="updateEmail2" type="email" size="20" name="updateEmail2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="submit" name="updateCompany" value="Update"></td>
                    </tr>
                </table>
            </div>
            
            <div id="removeCompanyPopBox" style="display:none" >
                <input id="closepopp" type="button" onclick="closeRemoveCompanyPop()" value="X">
                <h3 style="margin-left:10%">Are You Confirm To Remove The Company?</h3>
                <input id="removeId" type="hidden" size="40" name="removeId">
                <p align="center"><input type="submit" name="removeCompany" value="Remove"></p>
            </div>
            
            
            <p style="margin-left:3%;color:red">
            <?php
                
                if(isset($_POST['addCompany']))
                {
                    if($_POST['name']==null || $_POST['address']==null || $_POST['contact1']==null || $_POST['email1']==null)
                    {
                        echo "Please Fill Up All Information!";
                        echo "<br>";
                    }else{

                        $name=trim($_POST['name']);
                        $address=trim($_POST['address']);
                        $contact1=trim($_POST['contact1']);
                        $contact2=trim($_POST['contact2']);
                        $email1=($_POST['email1']);
                        $email2=($_POST['email2']);

                        echo $companyProcess->addCompany($name,$address,$contact1,$contact2,$email1,$email2);
                        echo "<br>";
                    }
                }else if(isset($_POST['updateCompany'])){
                    if($_POST['updateAddress']==null || $_POST['updateContact1']==null || $_POST['updateEmail1']==null)
                    {
                        echo "Please Fill Up All Information!";
                        echo "<br>";
                    }else{
                        $id=trim($_POST['updateId']);
                        $name=trim($_POST['updateName']);
                        $address=trim($_POST['updateAddress']);
                        $contact1=trim($_POST['updateContact1']);
                        $contact2=trim($_POST['updateContact2']);
                        $email1=($_POST['updateEmail1']);
                        $email2=($_POST['updateEmail2']);

                        echo $companyProcess->updateCompany($id,$address,$contact1,$contact2,$email1,$email2);
                        echo "<br>";
                    }
                }else if(isset($_POST['removeCompany'])){
                    $id=trim($_POST['removeId']);
                    echo $companyProcess->removeCompany($id);
                    echo "<br>";
                }
                
                echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Company List"."</h2>";
                echo "<a href=\"#\" style=\"margin-left:3%;\" onclick=\"addCompanyPop()\">Add New Company</a>";
                echo "<table id=\"table-v1\" align=\"center\" width=\"95%\">";
                echo "<tr>";
                echo "<th width=\"5%\">"."No"."</th>";
                echo "<th width=\"20%\">"."Company Name"."</th>";
                echo "<th width=\"20%\">"."Address"."</th>";
                echo "<th width=\"15%\">"."Contact Number"."</th>";
                echo "<th width=\"20%\">"."Email"."</th>";
                echo "<th width=\"15%\">"."Action"."</th>";
                echo "</tr>";

                $result=$companyProcess->displayCompany();
                while($real_result= mysqli_fetch_array($result))
                {
                    $num+=1;
                    echo "<tr align=\"center\">";
                    echo "<td>".$num."</td>";
                    echo "<td>".$real_result['name']."</td>";
                    echo "<td>".$real_result['address']."</td>";
                    echo "<td>".$real_result['contact1']."<br>".$real_result['contact2']."</td>";
                    echo "<td>".$real_result['email1']."<br>".$real_result['email2']."</td>";
                    echo "<td>"."<input id={$real_result['id']} style=\"width:70px;height:25px;cursor:pointer;\" type=\"button\" name=\"update\" value=\"UPDATE\" onclick=\"updateCompanyPop(this)\">"."&nbsp;&nbsp;"."<input id={$real_result["id"]} style=\"width:70px;height:25px;cursor:pointer;\" type=\"button\" name=\"delete\" value=\"DELETE\" onclick=\"removeCompanyPop(this)\">"."</td>";
                    echo "</tr>";
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
