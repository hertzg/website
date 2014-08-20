<?php

namespace ApiKeys;

function edit ($mysqli, $id, $name, $expire_time) {
    $name = $mysqli->real_escape_string($name);
    if ($expire_time === null) $expire_time = 'null';
    $sql = "update api_keys set name = '$name', expire_time = $expire_time,"
        ." num_edits = num_edits + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
