<?php

// require('../functions/databaseFunctions.php');
require('./functions/databaseFunctions.php');


function showPosts(){

    $sql = "SELECT posts.id, posts.title, posts.content, posts.date, users.username
            FROM posts
            JOIN user_posts ON posts.id = user_posts.post_id
            JOIN users ON user_posts.user_id = users.id
            ORDER BY posts.date DESC";

    $data = selectFromDb($sql);

    if(!empty($data)){
    
        foreach($data as $post){
            $id      = $post['id'];
            $title   = $post['title'];
            $content = $post['content'];
            $date    = $post['date'];
            $author  = $post['username'];

            if(existsLoggedUser() && isUserAdmin()){
                echo "
                <div class='post'>
                    <div class='postBar'>
                        
                        <h2>
                        <a href='./posts.php?id={$id}'>{$title}</a>
                        </h2>

                        
                        <div class='postOptions'>
                            <a href='./servers/deletePostServer.php?id={$id}'>Delete</a>
                        
                        </div>
                
                    </div>

        
                    <div class='postContent'>
                        
                        <p>Posted by: {$author}</p>
                        <p>Date: {$date}</p> <br>
                        <p>{$content}</p>
                    </div>
                    
                    <div class='postReadMore'>
                        <a href='./posts.php?id={$id}'>Read More</a>
                    </div>
                </div>";   
            } else {

                echo "
                <div class='post'>
                    <div class='postBar'>
                        
                        <h2>
                        <a href='./posts.php?id={$id}'>{$title}</a>
                        </h2>
                
                    </div>

                    

                    <div class='postContent'>
                        
                        <p>Posted by: {$author}</p>
                        <p>Date: {$date}</p> <br>
                        <p>{$content}</p>
                    </div>

                    <div class='postReadMore'>
                    <a href='./posts.php?id={$id}'>Read More</a>
                    </div>

                </div>";   
            }
                
            
        }

    } else {
        echo "No posts to show";
    }

}

function showThreads(){

    if(isset($_GET['id'])){
        $postId = $_GET['id'];
    } else {
        exit('No post id provided');
    }

    $sql = "SELECT threads.id, threads.content, threads.date, users.username
            FROM threads
            JOIN user_threads ON threads.id = user_threads.thread_id
            JOIN users ON user_threads.user_id = users.id
            JOIN post_threads ON threads.id = post_threads.thread_id
            WHERE post_threads.post_id = {$postId}";

    $data = selectFromDb($sql);

    if(!empty($data)){
        foreach($data as $thread){
            $threadId = $thread['id'];
            $content  = $thread['content'];
            $date     = $thread['date'];
            $author   = $thread['username'];

            if(existsLoggedUser() && isUserAdmin()){
                echo "
                <div class='thread'>
                    <div class='threadBar'>
                        
                        <h3>{$author}</h3>
                        <p>Date: {$date}</p>

                        <div class='threadOptions'>
                            <a href='./servers/deleteThreadServer.php?id={$threadId}'>Delete</a>
                        </div>
                
                    </div>

                    <div class='threadContent'>
                        <p>{$content}</p>
                    </div>
                    
                </div>";
            } else {
                echo "
                <div class='thread'>
                    <div class='threadBar'>
                        
                        <h3>{$author}</h3>
                        <p>Date: {$date}</p>

                    </div>

                    <div class='threadContent'>
                        <p>{$content}</p>
                    </div>
                    
                </div>";
            }

        }
    } else {
        echo "No threads to show";
    }
}


?>
