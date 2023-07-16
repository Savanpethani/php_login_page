<?php 
require_once ("../controller/dataconnection.php");
class register{
    private $db_handle;
    
    
    function __construct() {
        $this->db_handle = new dataconnection();
    }
    
    function adduser($uname,$email,$psd,$img) {
        
        
        $query = "INSERT INTO users (Firstname,username,dbpsd,profileimg) VALUES ('$uname','$email','$psd','$img')";
       
              
        $insertId = $this->db_handle->insert($query);
        return $insertId;
    }

    function getuser($uname,$pwd){
        
        $query="SELECT * FROM users WHERE Firstname = '$uname' ";
        
        $result= $this->db_handle->select($query,$pwd);
        
        return $result;
    }

    function getimg($email){
        $query="SELECT * FROM users WHERE Username = '$email' ";
        $img= $this->db_handle->imgname($query);
        return $img;
    }

    function getmail($uname){
        

        $query="SELECT * FROM users WHERE Firstname = '$uname' ";
        $mail= $this->db_handle->mail($query);
        
        return $mail;
    }
    function uppassword($uname,$dbpsd){
        $query="UPDATE users SET dbpsd='$dbpsd' WHERE Firstname = '$uname' ";
        $update= $this->db_handle->update($query);
        return $update;
    }
    function check($email){
        $query="SELECT * FROM users WHERE Username = '$email' ";
        $check= $this->db_handle->check($query);
              
        return $check;
    }
    function img($img_name){
        
        
        $query="INSERT INTO users (profileimg) VALUES ('$img_name') ";
        $insertimg = $this->db_handle->insert($query);
        return $insertimg;die;   
        
    }
    function updateprofile($uname,$img_name){
        $query="UPDATE users SET profileimg='$img_name' WHERE Username = '$uname' ";
        $update= $this->db_handle->update($query);
        return $update;
    }
    function getimgname($uname){
        

        $query="SELECT * FROM users WHERE Username = '$uname' ";
        $mail= $this->db_handle->img($query);
        
        return $mail;
    }
}   
?>