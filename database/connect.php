<?php

    function OpenCon() {

        $dbhost = getenv('DB_HOST');
        $dbuser = getenv('DB_USER');
        $dbpass = getenv('DB_PASS');
        $db = getenv('DB_NAME');

        apache_getenv();
        apache_setenv();
    
        if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
            $dbhost = "localhost:3307";
            $dbuser = "root";
            $dbpass = "vimizy";
            $db = "buildforsdg-project";
        }
        
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

        return $conn;
    }

    function CloseCon($conn) {
        $conn -> close();
    }
?>