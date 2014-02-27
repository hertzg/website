<?php

namespace Folders;

function add ($mysqli, $idusers, $parentidfolders, $foldername) {
    $foldername = $mysqli->real_escape_string($foldername);
    $inserttime = time();
    $sql = 'insert into folders'
        .' (idusers, parentidfolders, foldername, inserttime)'
        ." values ($idusers, $parentidfolders, '$foldername', $inserttime)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
