<?php

namespace ApiKeys;

function updateAccessTime ($mysqli, $id) {
    $access_time = time();
    $sql = "update api_keys set access_time = $access_time where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
