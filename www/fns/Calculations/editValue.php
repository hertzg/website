<?php

namespace Calculations;

function editValue ($mysqli, $id, $value, $error, $error_char) {

    if ($value === null) {
        $value = 'null';
        $error = "'".$mysqli->real_escape_string($error)."'";
    } else {
        $error = $error_char = 'null';
    }

    $sql = "update calculations set value = $value,"
        ." error = $error, error_char = $error_char where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
