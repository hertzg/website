<?php

namespace Users;

function editAccessTime ($mysqli, $id, $access_time) {
    $sql = "update users set access_time = $access_time where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
