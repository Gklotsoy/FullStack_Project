<?php

// require ('./functions/databaseFunctions.php');
require ('./functions/genericFunctions.php');
require ('./functions/userFunctions.php');

startSession();

if(isset($_SESSION['errorMessage'])){
$errorMessage = $_SESSION['errorMessage'] ?: "An error occurred";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="./css/errorPage.css">
</head>
<body>
    <div class="container">
        
        <?php
        if(isset($_SESSION['errorMessage'])){
            echo "<h1>$errorMessage</h1>";
        }
        ?>
        <br>
        <p>Sorry, an error occurred. Please try again later.</p>
        <br>
        <a href="./index.php">Go back to the forum</a>
    </div>
</body>
</html>