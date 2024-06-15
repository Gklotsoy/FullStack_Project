<?php

require ('../functions/genericFunctions.php');
require ('../functions/userFunctions.php');
require ('../functions/databaseFunctions.php');


startSession();

if(empty($postId = $_GET['id'])){
    redirectTo('./index.php');
}else {

    if(existsLoggedUser() && isUserAdmin()){
        $sql = "DELETE FROM 
                posts 
                WHERE id = {$postId}";
    
        $data = selectFromDb($sql);

        if(empty($data)){
            echo "Post deleted";
            redirectTo('../index.php');
        }else{
            echo "Error: Post not deleted";
        }
    }else{
        echo "You are not allowed to delete posts";
    }

}
