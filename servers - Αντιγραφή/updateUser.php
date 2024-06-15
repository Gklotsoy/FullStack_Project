<?php

require ('../functions/databaseFunctions.php');
require ('../functions/genericFunctions.php');
require ('../functions/userFunctions.php');

startSession();


if(isRequestMethodPost()){
    
    $userData = [
        'id'          => $id          = addslashes($_POST['id']),
        'username'    => $username    = addslashes($_POST['username']),
        'email'       => $email       = addslashes($_POST['email']),
        'password'    => $password    = addslashes($_POST['password']),
        'newPassword' => $newPassword = addslashes($_POST['newPassword']) ? addslashes($_POST['newPassword']) : null
    ];

    if($username != $_SESSION['loggedUsername']){
        $_SESSION['loggedUsername'] = $username;
    }

    $sql = "SELECT id
            FROM users 
            WHERE id = '{$id}' AND password = '{$password}'";

    $data = selectFromDb($sql);

    if(empty($data)){
        setAlertError('Invalid password.');
        redirectTo('../userProfile.php');
        exit();
    }
    
    $sql = "SELECT username, email
            FROM users 
            WHERE id != '{$id}' AND (username = '{$username}' OR email = '{$email}')";

    $data = selectFromDb($sql);

    if(!empty($data)){
        setAlertError('Username or email already exists.');
        redirectTo('../userProfile.php');
    
    }else if($newPassword !=null && $newPassword != $password){
        $sql = "UPDATE users
                SET username = '{$username}', email = '{$email}', password = '{$newPassword}'
                WHERE id = '{$id}'";
    } else{
        $sql = "UPDATE users
                SET username = '{$username}', email = '{$email}'
                WHERE id = '{$id}'";
    }

    executeQuery($sql);
    setAlertError('User updated successfully.');

    

    redirectTo('../userProfile.php');



    // if($updateResult){
    //     setAlertError('User updated successfully.');
    //     redirectTo('../userProfile.php');

    // } 
    // else{
    //     setAlertError('Error updating user.');
    //     redirectTo('../userProfile.php');
    // }

    
    
}else{
    setError('Invalid Request Method.');
    redirectTo('../errorPage.php');
}
?>