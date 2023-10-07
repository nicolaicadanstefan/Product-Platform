<?php

// The connection to phpMyAdmin database
    function OpenCon() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "Scandiweb";
        $conn = new mysqli($host, $user, $password,$db) or die("Connect failed: %s\n". $conn -> error);
        return $conn;
    }
    function CloseCon($conn) {
        $conn -> close();
    }