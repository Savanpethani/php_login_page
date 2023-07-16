<?php

session_start();



class dataconnection {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "test";
    private $conn;
    
    function __construct() {
        $this->conn = $this->connectDB();
    }   

    function check($sql){  
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            
            $email=$row['Username'];
            return $email;
        }

    
    }

    function imgname($sql){
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            
            $image_name=$row['profileimg'];
            return $image_name;
        }
    }

    function mail($sql){
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        $result=mysqli_query($conn,$sql);
       
        
        
        
       
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            
            $email=$row['Username'];
            return $email;
        }


    }

    function img($sql){
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        $result=mysqli_query($conn,$sql);
       
        
        
        
       
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            
            $email=$row['profileimg'];
            return $email;
        }


    }

    function select($sql,$pwd){
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        $result=mysqli_query($conn,$sql);
        
        
        //print_r ($result);
       
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
        $dbpwd = $row['dbpsd'];
        
        }
        if(md5($pwd)==$dbpwd)
        {
            
        return "yes";
        }
        else
        {
        return "No";
        }
    }
    
    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }
    
    function runBaseQuery($query) {
        $result = $this->conn->query($query);   
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    
    
    function runQuery($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }
    
    function insert($query) {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);

        
        mysqli_query($conn, $query);
        
       
        
        return "updated";
        // $sql = $this->conn->prepare($query);
        // // $this->bindQueryParams($sql, $param_type, $param_value_array);
        // // $sql->execute();
        // $insertId = $sql->insert_id;
        // return $insertId;
    }
    
    function update($query) {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        mysqli_query($conn, $query);
        return "updated";
    }
}
?>