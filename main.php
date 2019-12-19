<?php
    function connect_db(){
        $servername = "localhost:3306";
        $username = "root";
        $password = "zds12345#";
        $db = "csunplugged";
        $conn = new mysqli($servername, $username, $password, $db);
        return $conn;
    }
?>