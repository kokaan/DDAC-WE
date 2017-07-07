<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['id1']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id1']);
    $searchQuery="SELECT name FROM inbound_shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['name'];
}

if(isset($_POST['id2']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id2']);
    $searchQuery="SELECT destination FROM inbound_shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['destination'];
}

if(isset($_POST['id3']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id3']);
    $searchQuery="SELECT container FROM inbound_shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['container'];
}

if(isset($_POST['id4']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id4']);
    $searchQuery="SELECT createdate FROM inbound_shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['createdate'];
}

if(isset($_POST['id5']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id5']);
    $searchQuery="SELECT createtime FROM inbound_shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['createtime'];
}

if(isset($_POST['id6']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id6']);
    $searchQuery="SELECT yard FROM inbound_shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['yard'];
}

if(isset($_POST['name']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $name=trim($_POST['name']);
    $searchQuery="SELECT DISTINCT numberplate FROM vehicle_t where name='$name'";
    
    $result=mysqli_query($dblink, $searchQuery);
    echo "<option value=\"\">";
    echo "Select Vehicle";
    echo "</option>";
    while($real_result= mysqli_fetch_array($result)) 
    {
        echo "<option value=\"{$real_result['numberplate']}\">";
        echo $real_result['numberplate'];
        echo "</option>";
    }
}


