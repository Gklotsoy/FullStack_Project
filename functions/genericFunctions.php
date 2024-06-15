<?php

function startSession(){
    if(!isset($_SESSION)){
        session_start();
    }
}

function isRequestMethodPost(){
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function redirectTo($location){
    header("Location: $location");
    exit;
}

function setError($error){
    $_SESSION['errorMessage'] = $error;
}

function setAlertError($error){
    $_SESSION['alertError'] = $error;
}

function alertError($error){
    echo "<script>alert('$error')</script>";
}

