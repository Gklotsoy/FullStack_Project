<?php

require ('./functions/genericFunctions.php');
require ('./functions/userFunctions.php');

startSession();

if(isset($_SESSION['alertError'])){
    $alertError = $_SESSION['alertError'];
    echo "<script>alert('$alertError')</script>";
    unset($_SESSION['alertError']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/registerPage.css">
</head>
<body>
    <div class="container">
    <h1><a href="./index.php">ForumCommunity</a></h1>

    <div class="registerForm">
        <form action="./servers/userCreateServer.php" method="POST">
            
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required>
            <br>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" required>
            <br>
            <?php
                        
            if(isUserAdmin()){
                echo '
                <label for="role">Role</label>
                <br>
                <select name="role" id="role">

                    <option value="admin">Admin</option>
                    <option value="user">User</option>
            </select>
                <br>
                <button type="submit">Create</button>
                ';
            }else{
                echo '<button type="submit">SignUp</button>';
            }
            ?>
        
            

        </form>
    </div>    

    </div>
</body>
</html>