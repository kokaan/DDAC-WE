<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of companyProcess
 *
 * @author Kok Aan
 */
include 'dbConnection.php';
class companyProcess {
    //put your code here
    private $db;
    private $db_link;
    
    public function getDistinctCompany()
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT DISTINCT name FROM company_t";
        $result=mysqli_query($this->db_link, $searchQuery);

        return $result;
    }
    
    public function displayCompany()
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT * FROM company_t";
        $result=mysqli_query($this->db_link, $searchQuery);

        return $result;
    }
    
    public function addCompany($name,$address,$contact1,$contact2,$email1,$email2)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $searchQuery="SELECT name FROM company_t WHERE name='$name'";
        $result=mysqli_query($this->db_link, $searchQuery);
        if($result->num_rows>0)
        {
            return "Company Duplicate!";
        }else{
            //make sure company contact and email do not duplicate
            if($contact1==$contact2)
            {
                return "Contact Number Duplicate!";
            }else if($email1==$email2){
                return "Email Duplicate!";
            }else{
                $insertQuery="INSERT INTO company_t (id,name,address,contact1,contact2,email1,email2) VALUES ('','$name','$address','$contact1','$contact2','$email1','$email2')";
                mysqli_query($this->db_link, $insertQuery);
                return "New Company Added Successfully";
            }
            
        }
    }
    
    public function updateCompany($id,$address,$contact1,$contact2,$email1,$email2)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        //make sure company contact and email do not duplicate
        if($contact1==$contact2)
        {
            return "Contact Number Duplicate!";
        }else if($email1==$email2){
            return "Email Duplicate!";
        }else{
            $updateQuery="UPDATE company_t SET address='$address',contact1='$contact1',contact2='$contact2',email1='$email1',email2='$email2' WHERE id='$id'";
            mysqli_query($this->db_link, $updateQuery);
            return "Company Information Has Been Updated";
        }
    }
    
    public function removeCompany($idd)
    {
        $this->db=new dbConnection();
        $this->db_link=$this->db->dbConnect();
        
        $id=trim($idd);
        
        $searchQuery="SELECT name FROM company_t WHERE id='$id'";
        $result=mysqli_query($this->db_link, $searchQuery);
        $real_result=mysqli_fetch_array($result);
        $name=$real_result['name'];
        
        $deleteQuery1="DELETE FROM vehicle_t WHERE name='$name'";
        mysqli_query($this->db_link, $deleteQuery1);
        
        $deleteQuery2="DELETE FROM company_t WHERE ID='$id'";
        mysqli_query($this->db_link, $deleteQuery2);
    
        return "Selected Company Information Has Been Removed";
    }
}
