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
    $searchQuery="SELECT name FROM vehicle_t where id='$id'";
    
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
    $searchQuery="SELECT numberplate FROM vehicle_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['numberplate'];
}
