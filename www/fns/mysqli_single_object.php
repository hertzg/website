<?php

function mysqli_single_object ($mysqli, $sql) {
    $result = $mysqli->query($sql);
    if ($result) {
        $object = $result->fetch_object();
        $result->close();
        return $object;
    }
}
