<?php

namespace Tokens;

function editAccessTime ($mysqli, $id, $access_time) {
    $sql = "update tokens set access_time = $access_time where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
