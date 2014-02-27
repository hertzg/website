<?php

namespace Files;

function rename ($mysqli, $idusers, $id, $filename) {
    $filename = $mysqli->real_escape_string($filename);
    $sql = "update files set filename = '$filename'"
        ." where idusers = $idusers and idfiles = $id";
    $mysqli->query($sql);
}
