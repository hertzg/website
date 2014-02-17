<?php

namespace Files;

function move ($mysqli, $idusers, $id, $idfolders) {
    mysqli_query(
        $mysqli,
        "update files set idfolders = $idfolders"
        ." where idusers = $idusers and idfiles = $id"
    );
}
