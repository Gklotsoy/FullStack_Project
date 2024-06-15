<?php

// require('./functions/userFunctions.php');
require('./functions/genericFunctions.php');
require('./functions/databaseFunctions.php');

if(!startSession()){
    startSession();
}


function showUserData(){

    if(!existsLoggedUser()){
        redirectTo('login.php');
    }else{

        $username = ($_SESSION['loggedUsername']);

        $sql = "SELECT email, id
                FROM users 
                WHERE username = '$username'";

        $data = selectFromDb($sql);

        return $data;
    }
}