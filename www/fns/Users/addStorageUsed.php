<?php

namespace Users;

function addStorageUsed ($mysqli, $id, $storage_used) {
    $sql = "update users set storage_used = storage_used + $storage_used"
        ." where idusers = $id";
    $mysqli->query($sql);
}
