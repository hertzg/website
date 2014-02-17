<?php

namespace Files;

function rename ($mysqli, $idusers, $id, $filename) {
    $filename = mysqli_real_escape_string($mysqli, $filename);
    mysqli_query(
        $mysqli,
        "update files set filename = '$filename'"
        ." where idusers = $idusers and idfiles = $id"
    );
}
