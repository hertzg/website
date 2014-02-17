<?php

namespace Users;

function addStorageUsed ($mysqli, $id, $storageUsed) {
    $sql = "update users set storageused = storageused + $storageUsed"
        ." where idusers = $id";
    mysqli_query($mysqli, $sql);
}
