<?php

// require('./functions/genericFunctions.php');
require('./functions/userFunctions.php');
require('./functions/userProfileFunctions.php');



if(!existsLoggedUser()){
    redirectTo('login.php');
}

if(isset($_SESSION['alertError'])){
    $alertError = $_SESSION['alertError'];
    echo "<script>alert('$alertError')</script>";
    unset($_SESSION['alertError']);
}

$data = showUserData();
$email = $data[0]['email'];
$id = $data[0]['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profilePage.css">

</head>
<body>
    
    <div class="container">

        <div class="navbar">
            
            
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
            

        </div>

        <div class="profile">
            <h1>Profile</h1>
            <div class="profile-info">

                <div id="profileData">
                    <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $_SESSION['loggedUsername'] ?>" disabled>
                    <br>
                    <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email ?>" disabled>
                    <br>

                    <button id="editBtn">Edit</button>
                </div>


                <div class="updateForm hidden" id="updateForm">
                    <form action="./servers/updateUser.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $_SESSION['loggedUsername'] ?>" ><br>
                        <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $email ?>"><br>
                        <input type="password" name="password" id="password" placeholder="Password" required><br>
                        <label for="checkbox">Do you wand to change your Password?</label>
                        <input type="checkbox" name="chechbox" id="checkbox">
                        <br>
                        <input type="password" name="newPassword" id="newPassword" placeholder="New Password" class="hidden"> <br>
                        <button type="submit" id="update">Update</button><br>
                    </form>
                    <button id="cancelBtn">Cancel</button>
                </div>
                </div>
                

            </div>
        </div>

    </div>

</body>
<script src="js/profilePage.js"></script>
</html>