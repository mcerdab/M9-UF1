<?php

    try {
        $db_host = "localhost";
        $db_name = "fakelon";
        $db_user = "root";
        $db_port = "5306";
        $db_pass = "";
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name;port=$db_port", $db_user, $db_pass,array(PDO::ATTR_PERSISTENT => true));

    }catch(PDOException $e){
        echo 'Error amb la BDs: '. $e->getMessage();
    }
?>