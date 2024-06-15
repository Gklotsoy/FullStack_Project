<?php

require('../functions/databaseFunctions.php');
require('../functions/genericFunctions.php');
require('../functions/userFunctions.php');

startSession();

if(empty($threadId = $_GET['id'])){
    redirectTo('../index.php');
}else {
    if(existsLoggedUser() && isUserAdmin()){

        $sql = "SELECT post_id
                FROM post_threads
                WHERE thread_id = {$threadId}";

        $data = selectFromDb($sql);
        
        if(!empty($data)){
            foreach($data as $post){
                $postId = $post['post_id'];
            }
        }


        $sql = "DELETE 
                FROM threads 
                WHERE id = {$threadId}";

        $data = selectFromDb($sql);

        if(empty($data)){
            
            redirectTo('../posts.php?id=' . $postId);

        }else{
            
            echo "Error: Thread not deleted";
        }
    }else{
        echo "You are not allowed to delete threads";
    }
}

