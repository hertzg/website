<?php

namespace ApiKeys;

function edit ($mysqli, $id, $name) {
    $name = $mysqli->real_escape_string($name);
    $sql = "update api_keys set name = '$name' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
