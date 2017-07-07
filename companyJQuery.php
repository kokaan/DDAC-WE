<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['id1']))
{
    define('db_name','ddac');
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id1']);
    $searchQuery="SELECT name FROM company_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['name'];
}

if(isset($_POST['id2']))
{
    define('db_name','ddac');
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id2']);
    $searchQuery="SELECT address FROM company_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['address'];
}

if(isset($_POST['id3']))
{
    define('db_name','ddac');
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id3']);
    $searchQuery="SELECT contact1 FROM company_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['contact1'];
}

if(isset($_POST['id4']))
{
    define('db_name','ddac');
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id4']);
    $searchQuery="SELECT contact2 FROM company_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['contact2'];
}

if(isset($_POST['id5']))
{
    define('db_name','ddac');
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id5']);
    $searchQuery="SELECT email1 FROM company_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['email1'];
}

if(isset($_POST['id6']))
{
    define('db_name','ddac');
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    
    $dblink=mysqli_connect(db_host, db_user, db_pass);
    $db_found=mysqli_select_db($dblink,db_name);
    
    $id=trim($_POST['id6']);
    $searchQuery="SELECT email2 FROM company_t where id='$id'";
    
    $result=mysqli_query($dblink, $searchQuery);
    $real_result= mysqli_fetch_array($result);
    echo $real_result['email2'];
}