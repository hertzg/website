<?php

namespace Folders;

function move ($mysqli, $idusers, $idfolders, $parentidfolders) {
    $sql = "update folders set parentidfolders = $parentidfolders"
        ." where idusers = $idusers and idfolders = $idfolders";
    $mysqli->query($sql);
}
