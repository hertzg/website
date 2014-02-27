<?php

namespace Files;

function move ($mysqli, $idusers, $id, $idfolders) {
    $sql = "update files set idfolders = $idfolders"
        ." where idusers = $idusers and idfiles = $id";
    $mysqli->query($sql);
}
