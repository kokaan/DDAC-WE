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
    $searchQuery="SELECT createdate FROM shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['createdate'];
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
    $searchQuery="SELECT createtime FROM shipment_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['createtime'];
}

if(isset($_POST['destination']))
{
    define('db_name','ddac');
    define('db_host','kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com');
    define('db_user','kok12345@kok-ddac-sea-wa-mysqldbserver');
    define('db_pass','Kok@12345');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $destination=trim($_POST['destination']);
    $container=trim($_POST['container']);
    $searchQuery1="SELECT capacity FROM yard_t where destination='$destination'";
    $searchQuery2="SELECT yardname FROM yard_t where destination='$destination'";
    $result=mysqli_query($dblink, $searchQuery1);
    $real_result= mysqli_fetch_array($result);
    $capacity=$real_result['capacity'];
    
    $result=mysqli_query($dblink, $searchQuery2);
    if($container>$capacity)
    {
        echo "<option value=\"\">";
        echo "No Available Yard";
        echo "</option>";
    }else{
        echo "<option value=\"\">";
        echo "Select Yard";
        echo "</option>";
        while($real_result= mysqli_fetch_array($result)) 
        {
            echo "<option value=\"{$real_result['yardname']}\">";
            echo $real_result['yardname'];
            echo "</option>";
        }
    }
}

if(isset($_POST['destination1']))
{
 
    echo "<option value=\"\">";
    echo "Select Yard";
    echo "</option>";
        
}

