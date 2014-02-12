<?php

namespace Folders;

function add ($mysqli, $idusers, $parentidfolders, $foldername) {
    $foldername = mysqli_real_escape_string($mysqli, $foldername);
    $inserttime = time();
    mysqli_query(
        $mysqli,
        'insert into folders'
        .' (idusers, parentidfolders, foldername, inserttime)'
        ." values ($idusers, $parentidfolders, '$foldername', $inserttime)"
    );
    return mysqli_insert_id($mysqli);
}
