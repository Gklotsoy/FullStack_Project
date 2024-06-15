<?php

// require ('./functions/databaseFunctions.php');
require ('./functions/genericFunctions.php');
require ('./functions/userFunctions.php');

startSession();

showLoggedUser();

echo "<br>";

if(existsLoggedUser()){
    echo '<a href="./logout.php">Logout</a>' . '<br>';
}

echo '<a href="./userCreate.php">Add User</a>';