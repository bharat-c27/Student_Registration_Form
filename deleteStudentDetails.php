<?php

    if ( !isset($_GET["roll"])) {
        $roll = $_GET["id"];

        $servername = "";
        $username = "";
        $password = "";
        $database = "";
    
        $connection = new mysqli($servername, $username, $password, $database);
        
        $sql = "DELETE FROM students WHERE roll=$roll";
        $connection->query($sql);
    }

    header("location: /Student_Registration_Form/index.php");
    exit;
?>
