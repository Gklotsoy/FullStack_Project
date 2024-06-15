<?php

require ('../functions/databaseFunctions.php');
require ('../functions/genericFunctions.php');
require ('../functions/userFunctions.php');

startSession();

if(isRequestMethodPost()){
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);

    if(isset($username) && isset($password)){
        
        $sql = "SELECT username, role, id
                FROM users 
                WHERE username = '{$username}' AND password = '{$password}'";

        $data = selectFromDb($sql);


        if(!empty($data)){
            foreach($data as $userCredentials){


                $loginResult = logUserIn($userCredentials['username'], $userCredentials['role'], $userCredentials['id']);

                if($loginResult){
                    if(isset($_SESSION["alertError"])){
                        unset($_SESSION["alertError"]);
                    }
                    redirectTo('../index.php');
                } else {
                    alertError(
                        'Another user is already logged in.'
                    );
                    redirectTo('../login.php');
                }
            }


        } else {
            header('Location: ../login.php');
            setAlertError('Invalid username or password.');
            
        }

    }
}else{
    setError('Invalid Request Method.');
    redirectTo('../errorPage.php');
}