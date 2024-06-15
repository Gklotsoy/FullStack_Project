<?php

function connectToDatabase(){
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "forum_lab";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;

}

function checkEmtpyInput($input, $message = ""){
    if(empty($input)){
       echo $message;
        return true;
    }
    
}

function exitOnEmptyInput($parameter, $message = ''): void {
    if(empty($parameter)) {
        exit($message);
    }
}

function selectFromDb($sql){

    exitOnEmptyInput($sql, 'No SQL query provided');

    $conn   = connectToDatabase();
    $result = $conn->query($sql);
    $data   = [];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }

    $conn->close();
    return $data;

}

function executeQuery($sql){
    exitOnEmptyInput($sql, 'No SQL query provided');

    $conn = connectToDatabase();
    $result = $conn->query($sql);

    if(empty($result)){
        echo "Error: Failure to execute ". $sql . "<br>" ;
        
    }else{
        echo "Success: ". $sql . " executed successfully <br>";
        
    }
}