<?php

    if ( !isset($_GET["roll"])) {
        $roll = $_GET["id"];

        $servername = "localhost";
        $username = "root";
        $password = "#Squl3.8.1P";
        $database = "mini-project";
    
        $connection = new mysqli($servername, $username, $password, $database);
        
        $sql = "DELETE FROM students WHERE roll=$roll";
        $connection->query($sql);
    }

    header("location: /Student_Registration_Form/index.php");
    exit;
?>