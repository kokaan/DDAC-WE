<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of yardProcess
 *
 * @author Kok Aan
 */
include 'dbConnection.php';
class yardProcess {
    private $db;
    private $db_link;
    private $num=0;
    public function getDistinctDestination()
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT DISTINCT destination FROM yard_t";
        $result=mysqli_query($this->db_link, $searchQuery);

        return $result;
    }
    
    public function displayYard()
    {
        $result=$this->getDistinctDestination();
        echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Yard List"."</h2>";
        echo "<table id=\"table-v1\" align=\"center\" width=\"95%\">";
        echo "<tr>";
        echo "<th width=\"10%\">"."No"."</th>";
        echo "<th width=\"40%\">"."Location"."</th>";
        echo "<th width=\"30%\">"."Yard"."</th>";
        echo "<th width=\"15%\">"."Capacity"."</th>";
        echo "</tr>";
        
        while($real_result=mysqli_fetch_array($result))
        {
            $searchQuery="SELECT * FROM yard_t WHERE destination='".$real_result['destination']."'";
                    
            $this->num+=1;
            echo "<tr align=\"center\">";
            echo "<td>".$this->num."</td>";
            echo "<td>".$real_result['destination']."</td>";
            
            echo "<td>";
            $result1=mysqli_query($this->db_link, $searchQuery);
            while($real_result1 =mysqli_fetch_array($result1))
            {
                echo $real_result1['yardname'];
                echo "<br>";
            }
            echo "</td>";
            
            echo "<td>";
            $result2=mysqli_query($this->db_link, $searchQuery);
            while($real_result2 =mysqli_fetch_array($result2))
            {
                echo $real_result2['capacity'];
                echo "<br>";
            }
            echo "</td>";
            
            echo "</tr>";
        }
        echo "</table>";
    }
}
