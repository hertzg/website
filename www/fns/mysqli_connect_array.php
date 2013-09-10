<?php

function mysqli_connect_array (array $config) {
    extract($config);
    $mysqli = new mysqli($host, $user, $pass, $db);
    if (!$mysqli->connect_errno) {
        $mysqli->set_charset('utf8');
        return $mysqli;
    }
    return false;
}
