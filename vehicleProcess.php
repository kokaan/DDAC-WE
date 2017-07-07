<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehicleProcess
 *
 * @author Kok Aan
 */
class vehicleProcess {
    
    private $db;
    private $db_link;
    private $num=0;
    public function getDistinctCompany()
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT DISTINCT name FROM vehicle_t";
        $result=mysqli_query($this->db_link, $searchQuery);

        return $result;
    }
    
    public function displayVehicle()
    {
        $result=$this->getDistinctCompany();
        echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Vehicle List"."</h2>";
        echo "<a href=\"#\" style=\"margin-left:3%;\" onclick=\"addVehiclePop()\">Add New Vehicle</a>";
        echo "<table id=\"table-v1\" align=\"center\" width=\"95%\">";
        echo "<tr>";
        echo "<th width=\"10%\">"."No"."</th>";
        echo "<th width=\"40%\">"."Company Name"."</th>";
        echo "<th width=\"30%\">"."Vehicle Plate Number"."</th>";
        echo "<th width=\"15%\">"."Action"."</th>";
        echo "</tr>";
        
        while($real_result=mysqli_fetch_array($result))
        {
            $searchQuery="SELECT * FROM vehicle_t WHERE name='".$real_result['name']."'";
                    
            $this->num+=1;
            echo "<tr align=\"center\">";
            echo "<td>".$this->num."</td>";
            echo "<td>".$real_result['name']."</td>";
            
            echo "<td>";
            $result1=mysqli_query($this->db_link, $searchQuery);
            while($real_result1 =mysqli_fetch_array($result1))
            {
                echo $real_result1['numberplate'];
                echo "<br>";
            }
            echo "</td>";
            
            echo "<td>";
            $result2=mysqli_query($this->db_link, $searchQuery);
            while($real_result2 =mysqli_fetch_array($result2))
            {
                echo "<input id={$real_result2['id']} style=\"width:70px;height:25px;cursor:pointer;\" type=\"button\" name=\"update\" value=\"UPDATE\" onclick=\"updateVehiclePop(this)\">"."&nbsp;&nbsp;"."<input id={$real_result2["id"]} style=\"width:70px;height:25px;cursor:pointer;\" type=\"button\" name=\"delete\" value=\"DELETE\" onclick=\"removeVehiclePop(this)\">";
                echo "<br>";
            }
            echo "</td>";
            
            echo "</tr>";
        }
        echo "</table>";
    }
    
    public function addVehicle($name,$numberPlate)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT numberplate FROM vehicle_t WHERE numberplate='$numberPlate'";
        $result=mysqli_query($this->db_link, $searchQuery);
        if($result->num_rows>0)
        {
            return "Vehicle Duplicate!";
        }else{
            //make sure no vehicle number plate is duplicate
            $insertQuery="INSERT INTO vehicle_t (id,name,numberplate) VALUES ('','$name','$numberPlate')";
            mysqli_query($this->db_link, $insertQuery);
            return "New Vehicle Added Successfully";
            
        }
    }
    
    public function updateVehicle($id,$name,$numberPlate)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT numberplate FROM vehicle_t WHERE name='$name' AND numberplate='$numberPlate'";
        $result=mysqli_query($this->db_link, $searchQuery);
        if($result->num_rows>0)
        {
            return "Vehicle Duplicate!";
        }else{
            //make sure no vehicle number plate is duplicate
            $updateQuery="UPDATE vehicle_t SET numberplate='$numberPlate' WHERE id='$id'";
            mysqli_query($this->db_link, $updateQuery);
            return "Vehicle Information Has Been Updated";
        }
    }
    
    public function removeVehicle($idd)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $id=trim($idd);
        
        $deleteQuery="DELETE FROM vehicle_t WHERE ID='$id'";
        mysqli_query($this->db_link, $deleteQuery);
    
        return "Selected Vehicle Information Has Been Removed";
    }
}
