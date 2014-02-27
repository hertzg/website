<?php

namespace Folders;

function rename ($mysqli, $idusers, $idfolders, $foldername) {
    $foldername = $mysqli->real_escape_string($foldername);
    $sql = "update folders set foldername = '$foldername'"
        ." where idusers = $idusers and idfolders = $idfolders";
    $mysqli->query($sql);
}
