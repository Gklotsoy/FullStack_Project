<?php

require ('../functions/databaseFunctions.php');
require ('../functions/genericFunctions.php');
require ('../functions/userFunctions.php');

startSession();


if (isRequestMethodPost()) {
    
    $postData = [
        'title'   => $_POST['title'],
        'content' => $_POST['content'],
        'date'    => $date = date('Y-m-d H:i:s', 
                        strtotime('now +1 hours'))
        
    ];
    
    $fields = "";
    $values = "";

    foreach($postData as $field => $value){
        $fields .= "{$field}, ";
        $values .= "'{$value}', ";
    }

    $fields = rtrim($fields, ", ");
    $values = rtrim($values, ", ");

    $sql = "INSERT INTO posts ({$fields})
            VALUES ({$values})";
    
    

    executeQuery($sql);
    
    $sql = "SELECT id
            FROM posts
            WHERE title = '{$postData['title']}' AND content = '{$postData['content']}'";

    $data = selectFromDb($sql);

    if(!empty($data)){
        foreach($data as $post){
            $postId = $post['id'];
        }
    }


    $sql = "INSERT INTO user_posts (user_id, post_id)
            VALUES ('{$_SESSION['loggedUserId']}', '{$postId}')";

    executeQuery($sql);

    redirectTo('../index.php');
    


} else {
    redirectTo('../errorPage.php');
}