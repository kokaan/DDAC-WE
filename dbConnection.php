<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbConnection
 *
 * @author Kok Aan
 */
ob_start();
class dbConnection {
    
    private $db_name="ddac";
    private $db_host="kok-ddac-sea-wa-mysqldbserver.mysql.database.azure.com";
    private $db_user="kok12345@kok-ddac-sea-wa-mysqldbserver";
    private $db_pass="Kok@12345";

    public function dbConnect()
    {
        $db_link=  mysqli_connect($this->db_host, $this->db_user, $this->db_pass);
        mysqli_select_db($db_link, $this->db_name);
        
        return $db_link;
    }
}
