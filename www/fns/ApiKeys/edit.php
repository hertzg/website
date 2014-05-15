<?php

namespace ApiKeys;

function edit ($mysqli, $id, $name) {
    $name = $mysqli->real_escape_string($name);
    $sql = "update api_keys set name = '$name',"
        ." num_edits = num_edits + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
