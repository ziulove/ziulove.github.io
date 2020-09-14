<?php

    //database configuration
    $host       = "localhost";
    $user       = "efapp";
    $pass       = "123234";
    $database   = "efendiapp";

    $connect = new mysqli($host, $user, $pass, $database);

    if (!$connect) {
        die ("connection failed: " . mysqli_connect_error());
    } else {
        $connect->set_charset('utf8');
    }

?>