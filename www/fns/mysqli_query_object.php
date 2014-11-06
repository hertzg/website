<?php

function mysqli_query_object ($mysqli, $query) {
    $objects = [];
    $result = $mysqli->query($query);
    if ($result === false) {
        trigger_error($mysqli->error);
        return false;
    }
    if ($result) {
        while ($object = $result->fetch_object()) {
            $objects[] = $object;
        }
        $result->close();
        return $objects;
    }
}
