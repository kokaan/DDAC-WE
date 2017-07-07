<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inboundShipmentProcess
 *
 * @author Kok Aan
 */
include 'dbConnection.php';
class inboundShipmentProcess {
    private $db;
    private $db_link;
    private $num=0;
    private $shipmentCapacity=0;
    private $availableCapacity=0;
    private $remainingCapacity=0;
    
    public function getDistinctCompany()
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT DISTINCT name FROM outbound_shipment_t";
        $result=mysqli_query($this->db_link, $searchQuery);

        return $result;
    }
    
    public function updateShipmentVehicle($id,$vehicle)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery1="SELECT destination,capacity,yard FROM inbound_shipment_t WHERE id='$id'";
        $result1=mysqli_query($this->db_link, $searchQuery1);
        $real_result1=mysqli_fetch_array($result1);
        
        $destination=$real_result1['destination'];
        $this->shipmentCapacity=$real_result1['capacity'];
        $yard=$real_result1['yard'];
        
        $searchQuery2="SELECT capacity FROM yard_t WHERE destination='$destination' AND yardname='$yard'";
        $result2=mysqli_query($this->db_link, $searchQuery2);
        $real_result2=mysqli_fetch_array($result2);
        
        $this->availableCapacity=$real_result2['capacity'];
        
        $this->remainingCapacity=$this->availableCapacity+$this->shipmentCapacity;
        
        $updateQuery1="UPDATE inbound_shipment_t SET vehicle='$vehicle',status='Managed' WHERE id='$id'";
        mysqli_query($this->db_link, $updateQuery1);
        
        $updateQuery2="UPDATE yard_t SET capacity='$this->remainingCapacity' WHERE destination='$destination' AND yardname='$yard'";
        mysqli_query($this->db_link, $updateQuery2);
        
        return "Vehicle Has Been Assigned To The Shipment";
    }
    
    public function displayInboundWaitingShipment()
    {
        $result=$this->getDistinctCompany();
        
        echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Inbound Shipment List (Not Managed)"."</h2>";
        echo "<table id=\"table-v1\" align=\"center\" width=\"99%\">";
        echo "<tr>";
        echo "<th width=\"5%\">"."No"."</th>";
        echo "<th width=\"20%\">"."Company Name"."</th>";
        echo "<th width=\"13%\">"."Destination"."</th>";
        echo "<th width=\"13%\">"."Container Size"."</th>";
        echo "<th width=\"8%\">"."Date"."</th>";
        echo "<th width=\"7%\">"."Time"."</th>";
        echo "<th width=\"10%\">"."Yard"."</th>";
        echo "<th width=\"10%\">"."Vehicle"."</th>";
        echo "<th width=\"10%\">"."Action"."</th>";
        echo "</tr>";
        
        while($real_result=mysqli_fetch_array($result))
        {
            $searchQuery="SELECT * FROM inbound_shipment_t WHERE name='".$real_result['name']."' AND status='Not Managed' ORDER BY createdate,createtime";
            $result0=mysqli_query($this->db_link, $searchQuery);   
            $real_result0 =mysqli_fetch_array($result0);
            if($real_result0['name']==null)
            {
                
            }else{
                $this->num+=1;
                echo "<tr align=\"center\">";
                echo "<td>".$this->num."</td>";
                echo "<td>".$real_result0['name']."</td>"; 
                echo "<td>";
                
                $result1=mysqli_query($this->db_link, $searchQuery);
                while($real_result1 =mysqli_fetch_array($result1))
                {
                    echo $real_result1['destination'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result2=mysqli_query($this->db_link, $searchQuery);
                while($real_result2=mysqli_fetch_array($result2))
                {
                    echo $real_result2['container'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result3=mysqli_query($this->db_link, $searchQuery);
                while($real_result3=mysqli_fetch_array($result3))
                {
                    echo $real_result3['createdate'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result4=mysqli_query($this->db_link, $searchQuery);
                while($real_result4=mysqli_fetch_array($result4))
                {
                    echo $real_result4['createtime'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result5=mysqli_query($this->db_link, $searchQuery);
                while($real_result5=mysqli_fetch_array($result5))
                {
                    echo $real_result5['yard'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                echo "PLEASE UPDATE VEHICLE";
                echo "</td>";

                echo "<td>";
                $result7=mysqli_query($this->db_link, $searchQuery);
                while($real_result7=mysqli_fetch_array($result7))
                {
                    echo "<input id={$real_result7['id']} style=\"width:70px;height:25px;cursor:pointer;\" type=\"button\" name=\"update\" value=\"UPDATE\" onclick=\"updateShippingVehiclePop(this)\">";
                    echo "<br>";
                }
                echo "</td>";

                echo "</tr>";
                }
        }
        echo "</table>";
    }
    
    public function displayInboundCompletedShipment()
    {
        $result=$this->getDistinctCompany();
        
        echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Inbound Shipment List (Managed)"."</h2>";
        echo "<table id=\"table-v1\" align=\"center\" width=\"99%\">";
        echo "<tr>";
        echo "<th width=\"5%\">"."No"."</th>";
        echo "<th width=\"20%\">"."Company Name"."</th>";
        echo "<th width=\"15%\">"."Destination"."</th>";
        echo "<th width=\"15%\">"."Container Size"."</th>";
        echo "<th width=\"10%\">"."Date"."</th>";
        echo "<th width=\"10%\">"."Time"."</th>";
        echo "<th width=\"10%\">"."Yard"."</th>";
        echo "<th width=\"10%\">"."Vehicle"."</th>";
        echo "</tr>";
        
        while($real_result=mysqli_fetch_array($result))
        {
            $searchQuery="SELECT * FROM inbound_shipment_t WHERE name='".$real_result['name']."' AND status='Managed' ORDER BY createdate,createtime";
            $result0=mysqli_query($this->db_link, $searchQuery);   
            $real_result0 =mysqli_fetch_array($result0);
            if($real_result0['name']==null)
            {
                
            }else{
                $this->num+=1;
                echo "<tr align=\"center\">";
                echo "<td>".$this->num."</td>";
                echo "<td>".$real_result0['name']."</td>"; 
                echo "<td>";
                
                $result1=mysqli_query($this->db_link, $searchQuery);
                while($real_result1 =mysqli_fetch_array($result1))
                {
                    echo $real_result1['destination'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result2=mysqli_query($this->db_link, $searchQuery);
                while($real_result2=mysqli_fetch_array($result2))
                {
                    echo $real_result2['container'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result3=mysqli_query($this->db_link, $searchQuery);
                while($real_result3=mysqli_fetch_array($result3))
                {
                    echo $real_result3['createdate'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result4=mysqli_query($this->db_link, $searchQuery);
                while($real_result4=mysqli_fetch_array($result4))
                {
                    echo $real_result4['createtime'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result5=mysqli_query($this->db_link, $searchQuery);
                while($real_result5=mysqli_fetch_array($result5))
                {
                    echo $real_result5['yard'];
                    echo "<br>";
                }
                echo "</td>";

                echo "<td>";
                $result6=mysqli_query($this->db_link, $searchQuery);
                while($real_result6=mysqli_fetch_array($result6))
                {
                    echo $real_result6['vehicle'];
                    echo "<br>";
                }
                echo "</td>";

                echo "</tr>";
                }
        }
        echo "</table>";
    }
}
