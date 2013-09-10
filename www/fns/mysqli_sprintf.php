<?php

function mysqli_sprintf ($mysqli, $sql, $values) {
    global $mysqli_sprintf_args, $mysqli_sprintf_mysqli;
    $mysqli_sprintf_args = $values;
    $mysqli_sprintf_mysqli = $mysqli;
    return preg_replace_callback('/#([bsu])/', function ($match) {
        global $mysqli_sprintf_args, $mysqli_sprintf_mysqli;
        $value = array_shift($mysqli_sprintf_args);
        $key = $match[1];
        if ($key == 'b') {
            return $value ? '1' : '0';
        }
        if ($key == 's') {
            return $mysqli_sprintf_mysqli->real_escape_string($value);
        }
        return number_format((double)$value, 0, '', '');
    }, $sql);
}
