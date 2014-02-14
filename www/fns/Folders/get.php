<?php

namespace Folders;

function get ($mysqli, $idusers, $idfolders) {
    $sql = 'select * from folders'
        ." where idusers = $idusers and idfolders = $idfolders";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
