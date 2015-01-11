<?php

namespace Wallets;

function edit ($mysqli, $id, $name) {
    $name = $mysqli->real_escape_string($name);
    $update_time = time();
    $sql = "update wallets set name = '$name',"
        ." revision = revision + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
