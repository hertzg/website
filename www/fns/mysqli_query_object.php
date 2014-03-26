<?php

function mysqli_query_object ($mysqli, $query) {
    $objects = array();
    $result = $mysqli->query($query);
    if ($result == false) trigger_error($mysqli->error);
    if ($result) {
        while ($object = $result->fetch_object()) {
            $objects[] = $object;
        }
        $result->close();
        return $objects;
    }
}
