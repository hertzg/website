<?php

namespace Folders;

function add ($mysqli, $idusers, $parentidfolders, $foldername) {
    $foldername = $mysqli->real_escape_string($foldername);
    $insert_time = time();
    $sql = 'insert into folders'
        .' (idusers, parentidfolders, foldername, insert_time)'
        ." values ($idusers, $parentidfolders, '$foldername', $insert_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
