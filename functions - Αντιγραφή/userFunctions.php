<?php

function existActiveSession(){
    
    return session_status() === 2;
}

function existsLoggedUser(){
    return isset($_SESSION['loggedUsername']) && isset($_SESSION['loggedUserRole']);
}

function isUserAdmin(){
    if(existsLoggedUser()){
        return $_SESSION['loggedUserRole'] === 'admin';
    }

    return false;
}

function showLoggedUser(){
    if(existsLoggedUser()){
        echo 'Logged as ' . 
        $_SESSION['loggedUsername'] . "<br>".
        'Role: ' .
        $_SESSION['loggedUserRole'];

    }else{
        echo "Guest";
    }
}

function logUserIn($username, $role, $id){
    
    if(!existsLoggedUser()){
        $_SESSION['loggedUsername'] = $username;
        $_SESSION['loggedUserRole'] = $role;
        $_SESSION['loggedUserId'] = $id;
    
        return true;
    }

    return false;
}


function logUserOut(){
    if(existsLoggedUser()){
        unset($_SESSION['loggedUsername']);
        unset($_SESSION['loggedUserRole']);
        unset($_SESSION['loggedUserId']);
    }
}

