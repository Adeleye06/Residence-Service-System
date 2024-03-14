<?php
if (session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

function quitIfNotStudent(){
    quitIfNotLoggedIn();

    if(isset($_SESSION['USER_TYPE'])){
        //header("refresh:3; url=index.php");
        die("Admin can not access this page");
    }

}

function quitIfNotAdmin(){
    quitIfNotLoggedIn();

    if(!isset($_SESSION['USER_TYPE'])){
        //header("refresh:3; url=index.php");
        die("Students can not access this page");
    }

}

function quitIfNotLoggedIn(){
    if(!loggedIn()){
        //header("refresh:3; url=index.php");
        die("You did not log in, redirecting to log in page in 3 seconds");
    }
}

function loggedIn(){
    return isset($_SESSION['U_ID']);
}