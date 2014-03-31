<?php

namespace Users;

function addStorageUsed ($mysqli, $id, $storage_used) {
    $sql = "update users set storage_used = storage_used + $storage_used"
        ." where id_users = $id";
    $mysqli->query($sql);
}
