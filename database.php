<?php

function database(){
    $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}