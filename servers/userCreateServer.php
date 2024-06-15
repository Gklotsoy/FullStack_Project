<?php

require ('../functions/databaseFunctions.php');
require ('../functions/genericFunctions.php');
require ('../functions/userFunctions.php');

startSession();

if(isRequestMethodPost()){

    $userData = [
        'username' => addslashes($_POST['username']),
        'password' => addslashes($_POST['password']),
        'email'    => addslashes($_POST['email']),
        'role'     => addslashes($_POST['role']) ? addslashes($_POST['role']) : 'user'
    ];

   

    $user_name = $userData['username'];
    $email     = $userData['email'];

    $sql = "SELECT username, email
            FROM users 
            WHERE username = '{$user_name}' OR email = '{$email}'";

    $data = selectFromDb($sql);

    if(!empty($data)){
        setAlertError(
            'Username or Email already exists.'
        );
        redirectTo('../register.php');
        exit();
    }

    $fields = "";
    $values = "";

    foreach($userData as $field => $value){
        $fields .= "{$field}, ";
        $values .= "'{$value}', ";
    }

    $fields = rtrim($fields, ", ");
    $values = rtrim($values, ", ");

    $sql = "INSERT INTO users ({$fields})
            VALUES ({$values})";

    executeQuery($sql);
    redirectTo('../index.php');

    if(isset($_SESSION["alertError"])){
        unset($_SESSION["alertError"]);
    }

}else{
    setError('Invalid Request Method.');
    redirectTo('../errorPage.php');
}

?>