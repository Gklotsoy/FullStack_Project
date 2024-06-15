<?php

require('../functions/databaseFunctions.php');
require('../functions/genericFunctions.php');
require('../functions/userFunctions.php');

startSession();

if(isRequestMethodPost() && existsLoggedUser()){

    
    $userId = $_SESSION['loggedUserId'];
    $postId = $_POST['postId'];
    
    $threadData   =  [
        'content' => $_POST['content'],
        'date'    => $date = date('Y-m-d H:i:s', 
                        strtotime('now +1 hours'))
    ];

    
    $fields = "";
    $values = "";

    foreach($threadData as $field => $value){
        $fields .= $field . ', ';
        $values .= "'" . $value . "', ";
    }
    
    $fields = rtrim($fields, ", ");
    $values = rtrim($values, ", ");

    $sql = "INSERT INTO threads ({$fields})
            VALUES ({$values})";


    executeQuery($sql);

    $sql = "SELECT id
            FROM threads
            WHERE content = '{$threadData['content']}' AND date = '{$threadData['date']}'";

    $data = selectFromDb($sql);

    if(!empty($data)){
        foreach($data as $thread){
            $threadId = $thread['id'];
        }
    }

    $sql = "INSERT INTO user_threads (user_id, thread_id)
            VALUES ('{$userId}', '{$threadId}')";

    executeQuery($sql);

    $sql = "INSERT INTO post_threads (post_id, thread_id)
            VALUES ('{$postId}', '{$threadId}')";

    executeQuery($sql);

    redirectTo('../posts.php?id=' . $postId);

}else{
    redirectTo('../index.php');
}

