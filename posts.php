<?php
require ('./functions/genericFunctions.php');
require ('./functions/userFunctions.php');
require ('./functions/postThreadFunctions.php');

startSession();

if(empty($postId = $_GET['id'])){
    redirectTo('./index.php');
}else {
    $sql = "SELECT posts.id, posts.title, posts.content, posts.date, users.username, user_posts.user_id
            FROM posts
            JOIN user_posts ON posts.id = user_posts.post_id
            JOIN users ON user_posts.user_id = users.id
            WHERE posts.id = {$postId}";

    $post = selectFromDb($sql);

    if(empty($post)){
        echo "No post found";
        exit();
    }else{
        foreach($post as $post){
            $id      = $post['id'];
            $title   = $post['title'];
            $content = $post['content'];
            $date    = $post['date'];
            $author  = $post['username'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./css/posts.css">

</head>

<body>

    <div class="container">

        <div class="navbar">

            <a href="./index.php">Home</a>
            
            <?php
            if(existsLoggedUser()){
                echo '<a href="./logout.php">Logout</a>';
            } else {
                echo '<a href="./login.php">Login</a>';
                echo '<a href="./register.php">Register</a>';
            }
            ?>
        </div>

        <div class="content">
            <div class="post">
                <div class="postbar">
                    <h1><?php echo $title; ?></h1>
                </div>

                <div class="postContent">
                    <p>Posted by: <?php echo $author; ?></p>
                    <p>Date: <?php echo $date; ?></p>
                    <p><?php echo $content; ?></p>
                </div>

                <span><hr></span>
                
                <div class="threadsContainer">
                    <?php
                    
                    showThreads();

                    if(existsLoggedUser()){
                        echo '
                        <div class="addThread id="addThead">
                            
                            <form action="./servers/createThreadServer.php" method="POST">
                                <input type="hidden" id="postId" name="postId" value="'.$id.'">
                                <textarea id="content" name="content" placeholder="Comment" required></textarea><br>
                                <button type="submit">Publish</button>
                            </form>
                        </div>';
                    }

                    ?>
                </div>
            </div>
            

        </div>
        
    </div>

</body>


<script src="./tinymce/tinymce.min.js"></script>
<script src="./js/postScript.js"></script>
</html>