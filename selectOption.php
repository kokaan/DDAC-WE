<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of selectOption
 *
 * @author Kok Aan
 */
class selectOption {
    //put your code here
    public function getDistinctDestination()
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT DISTINCT destination FROM yard_t";
        $result=mysqli_query($this->db_link, $searchQuery);

        return $result;
    }
}
