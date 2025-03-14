<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "local_government_unit";

    $conn =  new mysqli ('localhost', 'root', '', 'local_government_unit');

    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>