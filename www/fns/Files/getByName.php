<?php

namespace Files;

function getByName ($mysqli, $idusers, $idfolders, $filename, $excludeid = 0) {
    $filename = mysqli_real_escape_string($mysqli, $filename);
    $sql = 'select * from files'
        ." where idusers = $idusers and idfolders = $idfolders"
        ." and filename = '$filename' and idfiles != $excludeid";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
