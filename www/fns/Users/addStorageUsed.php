<?php

namespace Users;

function addStorageUsed ($mysqli, $id, $storage_used, $num_files) {
    $sql = "update users set storage_used = storage_used + $storage_used,"
        ." num_files = num_files + $num_files where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
