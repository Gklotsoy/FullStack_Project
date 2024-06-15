<?php

require ('./functions/databaseFunctions.php');
require ('./functions/genericFunctions.php');
require ('./functions/userFunctions.php');

startSession();

if(existsLoggedUser()){
 redirectTo('index.php');
}

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
    <title>Forum</title>
    <link rel="stylesheet" href="./css/loginPage.css">
</head>
<body>
    <div class="container">
        <h1><a href="./index.php">ForumCommunity</a></h1>
        <div class="loginForm">
            <form action="./servers/loginServer.php" method="POST">

                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" required>
                    <br>
                <label for="password">Password</label>
                <br>
                <input type="password" name="password" id="password" required>
                <br>
                <button type="submit">Login</button>


            </form>
            
        </div>
    </div>
</body>
</html>



<?php

if(existsLoggedUser()){
    echo '<a href="./logout.php">Logout</a>';
}