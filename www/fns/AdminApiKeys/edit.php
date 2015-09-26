<?php

namespace AdminApiKeys;

function edit ($mysqli, $id, $name) {
    $name = $mysqli->real_escape_string($name);
    $sql = "update admin_api_keys set name = '$name' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
