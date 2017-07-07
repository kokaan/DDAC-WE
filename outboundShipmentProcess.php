<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of outboundShipmentProcess
 *
 * @author Kok Aan
 */
//include 'dbConnection.php';
class outboundShipmentProcess {
    //put your code here
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
    
    public function displaySchedule($createDate,$createTime)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT * FROM shipment_t WHERE createdate='$createDate' AND createtime='$createTime'";
        $result=mysqli_query($this->db_link, $searchQuery);
        
        return $result;
    }
    
    public function bookShipment($name,$destination,$container,$createDate,$createTime,$yard)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        if($container=="3m*3m Container")
        {
            $this->shipmentCapacity=9;
        }else if($container=="5m*5m Container"){
            $this->shipmentCapacity=25;
        }else if($container=="7m*7m Container"){
            $this->shipmentCapacity=49;
        }
        
        $searchQuery="SELECT capacity FROM yard_t WHERE destination='$destination' AND yardname='$yard'";
        $result=mysqli_query($this->db_link, $searchQuery);
        $real_result=mysqli_fetch_array($result);
        $this->availableCapacity=$real_result['capacity'];
        
        
        
        if($this->shipmentCapacity>$this->availableCapacity)
        {
            return "NO AVAILABLE YARD";
        }else{
            /*$this->remainingCapacity=$this->availableCapacity-$this->shipmentCapacity;
            
            $updateQuery="UPDATE yard_t SET capacity='$this->remainingCapacity' WHERE destination='$destination' AND yardname='$yard'";
            mysqli_query($this->db_link, $updateQuery);
            
            //delete the schedule*/
            
            $insertQuery="INSERT INTO outbound_shipment_t (id,name,destination,container,capacity,createdate,createtime,yard,status) VALUES ('','$name','$destination','$container','$this->shipmentCapacity','$createDate','$createTime','$yard','Booked')";
            mysqli_query($this->db_link, $insertQuery);
            return "Shipment Has Been Booked";
        }
    }
    
    public function updateShipment($id,$name,$destination,$container,$createDate,$createTime,$yard)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        if($container=="3m*3m Container")
        {
            $this->shipmentCapacity=9;
        }else if($container=="5m*5m Container"){
            $this->shipmentCapacity=25;
        }else if($container=="5m*5m Container"){
            $this->shipmentCapacity=49;
        }
        
        $searchQuery="SELECT capacity FROM yard_t WHERE destination='$destination' AND yardname='$yard'";
        $result=mysqli_query($this->db_link, $searchQuery);
        $real_result=mysqli_fetch_array($result);
        $this->availableCapacity=$real_result['capacity'];
        
        if($this->shipmentCapacity>$this->availableCapacity)
        {
            return "NO AVAILABLE YARD";
        }else{
            $updateQuery="UPDATE outbound_shipment_t SET name='$name',destination='$destination',container='$container',capacity='$this->shipmentCapacity',yard='$yard' WHERE id='$id'";
            mysqli_query($this->db_link, $updateQuery);
            
            return "Shipment Has Been Updated";
        }
    }
    
    public function removeShipment($idd)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $id=trim($idd);
        
        $deleteQuery="DELETE FROM outbound_shipment_t WHERE ID='$id'";
        mysqli_query($this->db_link, $deleteQuery);
    
        return "Selected Shipment Has Been Cancel";
    }
    
    public function confirmShipment($idd)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $id=trim($idd);
        
        $searchQuery1="SELECT * FROM outbound_shipment_t WHERE id='$id'";
        $result1=mysqli_query($this->db_link, $searchQuery1);
        $real_result1=mysqli_fetch_array($result1);
        
        $name=$real_result1['name'];
        $destination=$real_result1['destination'];
        $container=$real_result1['container'];
        $this->shipmentCapacity=$real_result1['capacity'];
        $createDate=$real_result1['createdate'];
        $createTime=$real_result1['createtime'];
        $yard=$real_result1['yard'];
        
        $searchQuery2="SELECT capacity FROM yard_t WHERE destination='$destination' AND yardname='$yard'";
        $result2=mysqli_query($this->db_link, $searchQuery2);
        $real_result2=mysqli_fetch_array($result2);
        
        $this->availableCapacity=$real_result2['capacity'];
        
        if($this->shipmentCapacity>$this->availableCapacity)
        {
            return "NO AVAILABLE YARD";
        }else{
            $this->remainingCapacity=$this->availableCapacity-$this->shipmentCapacity;
            
            $updateQuery1="UPDATE outbound_shipment_t SET status='Confirmed' WHERE id='$id'";
            mysqli_query($this->db_link, $updateQuery1);
            
            $insertQuery="INSERT INTO inbound_shipment_t(id,name,destination,container,capacity,createdate,createtime,yard,vehicle,status) VALUES ('','$name','$destination','$container','$this->shipmentCapacity','$createDate','$createTime','$yard','','Not Managed')";
            mysqli_query($this->db_link, $insertQuery);
            
            $updateQuery2="UPDATE yard_t SET capacity='$this->remainingCapacity' WHERE destination='$destination' AND yardname='$yard'";
            mysqli_query($this->db_link, $updateQuery2);

            return "Selected Shipment Has Been Shipped";
        }
    }
    
    public function displayOutboundBookedShipment()
    {
        $result=$this->getDistinctCompany();
        
        echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Booked Shipment List"."</h2>";
        echo "<table id=\"table-v1\" align=\"center\" width=\"99%\">";
        echo "<tr>";
        echo "<th width=\"5%\">"."No"."</th>";
        echo "<th width=\"20%\">"."Company Name"."</th>";
        echo "<th width=\"13%\">"."Destination"."</th>";
        echo "<th width=\"13%\">"."Container Size"."</th>";
        echo "<th width=\"8%\">"."Date"."</th>";
        echo "<th width=\"7%\">"."Time"."</th>";
        echo "<th width=\"10%\">"."Yard"."</th>";
        echo "<th width=\"23%\">"."Action"."</th>";
        echo "</tr>";
        
        while($real_result=mysqli_fetch_array($result))
        {
            $searchQuery="SELECT * FROM outbound_shipment_t WHERE name='".$real_result['name']."' AND status='Booked' ORDER BY createdate,createtime";
            $result0=mysqli_query($this->db_link, $searchQuery);   
            $real_result0 =mysqli_fetch_array($result0);
            if($real_result0['name']==null)
            {
                
            }else{        
                $this->num+=1;
                echo "<tr align=\"center\">";
                echo "<td>".$this->num."</td>";
                echo "<td>".$real_result['name']."</td>";

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
                    echo "<input id={$real_result6['id']} style=\"width:70px;height:25px;cursor:pointer;\" type=\"button\" name=\"update\" value=\"UPDATE\" onclick=\"updateShippingRequestPop(this)\">"."&nbsp;&nbsp;"."<input id={$real_result6["id"]} style=\"width:70px;height:25px;cursor:pointer;\" type=\"button\" name=\"delete\" value=\"DELETE\" onclick=\"removeShippingRequestPop(this)\">"."&nbsp;&nbsp;"."<input id={$real_result6["id"]} style=\"width:75px;height:25px;cursor:pointer;\" type=\"button\" name=\"confirm\" value=\"CONFIRM\" onclick=\"confirmShippingRequestPop(this)\">";
                    echo "<br>";
                }
                echo "</td>";

                echo "</tr>";
            }
        }
        
        echo "</table>";
    }
    
    public function displayOutboundConfirmedShipment()
    {
        $result=$this->getDistinctCompany();
        
        echo "<h2 style=\"margin-top:-1%;margin-left:3%;\">"."Confirmed Shipment List"."</h2>";
        echo "<table id=\"table-v1\" align=\"center\" width=\"99%\">";
        echo "<tr>";
        echo "<th width=\"5%\">"."No"."</th>";
        echo "<th width=\"25%\">"."Company Name"."</th>";
        echo "<th width=\"15%\">"."Destination"."</th>";
        echo "<th width=\"15%\">"."Container Size"."</th>";
        echo "<th width=\"13%\">"."Date"."</th>";
        echo "<th width=\"13%\">"."Time"."</th>";
        echo "<th width=\"13%\">"."Yard"."</th>";
        echo "</tr>";
        
        while($real_result=mysqli_fetch_array($result))
        {
            $searchQuery="SELECT * FROM outbound_shipment_t WHERE name='".$real_result['name']."' AND status='Confirmed' ORDER BY createdate,createtime";
            $result0=mysqli_query($this->db_link, $searchQuery);   
            $real_result0 =mysqli_fetch_array($result0);
            if($real_result0['name']==null)
            {
                
            }else{        
                $this->num+=1;
                echo "<tr align=\"center\">";
                echo "<td>".$this->num."</td>";
                echo "<td>".$real_result['name']."</td>";

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

                echo "</tr>";
            }
        }
        
        echo "</table>";
    }
}
