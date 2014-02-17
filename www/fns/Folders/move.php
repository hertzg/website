<?php

namespace Folders;

function move ($mysqli, $idusers, $idfolders, $parentidfolders) {
    mysqli_query(
        $mysqli,
        "update folders set parentidfolders = $parentidfolders"
        ." where idusers = $idusers and idfolders = $idfolders"
    );
}
