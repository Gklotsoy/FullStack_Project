<?php

require ('./functions/genericFunctions.php');
require ('./functions/userFunctions.php');
require ('./functions/postThreadFunctions.php');

startSession();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.cdnfonts.com/css/" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>


    <div class="container">

        <div class="modal" id="loginModal">
            <div class="modal-content" id="loginContent">
                <span class="close">&times;</span> <br>
                <h2>Login</h2>
                <form action="./servers/loginServer.php" method="post">
                    <input type="text" id="username" name="username" placeholder="Username" required><br>
                    <input type="password" id="password" name="password" placeholder="Password" required><br>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>

        <div class="modal" id="registerModal">
            <div class="modal-content" id="registerContent">
                <span class="close">&times;</span> <br>
                <h2>Register</h2>
                <form action="./servers/userCreateServer.php" method="post">
                    <input type="text" id="username" name="username" placeholder="Username" required><br>
                    <input type="password" id="password" name="password" placeholder="Password" required><br>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <button type="submit" >Register</button>
                </form>
            </div>
        </div>

        <div class="modal" id="newPostModal">
            <div class="modal-content" id="newPostContent">
                <span class="close">&times;</span> <br>
                <h2>New Post</h2>
                <form action="./servers/createPostServer.php" method="post" id="postForm">
                    <input type="text" id="title" name="title" placeholder="Title" required><br>
                    <textarea id="content" name="content" placeholder="Content" required></textarea><br>
                    <button type="submit">Publish</button>
                </form>
            
        </div>

        </div>
            <div class="topnav" id="myTopnav">

                <h2><a href="index.php">ForumCommunity</a></h2>

                <?php
                    if(existsLoggedUser()){
                        echo '
                        
                        <button class="newPostBtn" id="newPostBtn">Compose</button>
                        ';

                    }
                ?>

                
            </div>

            
            <div class="sidenav">

                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                

                
               <span> <hr> </span>

               <?php
                    if(!existsLoggedUser()){
                        
                        echo '
                        <button id="loginBtn"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                        <button id="registerBtn"><i class="fa-solid fa-user-plus"></i> Register</button>';

                    } else {
                        
                        if(isUserAdmin()){
                            echo '
                            <a href="register.php"><i class="fa-solid fa-user-tie"></i> Create User</a>';
                        }

                        echo '<a href="userProfile.php"><i class="fa-solid fa-user"></i> Profile</a>';

                        echo '<a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>';

                    }

                 
                ?>



            </div>
                
            <div class="main">
                <div class="postSection">

                    <?php
                    
                    showPosts();
                    ?>
                </div>
            </div>

           

        </div>
            
    </div>
</body>


<script src="./tinymce/tinymce.min.js"></script>
<script src="./js/script.js"></script>
</html>