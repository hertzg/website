<?php

namespace Folders;

function getByName ($mysqli, $idusers, $parentidfolders, $foldername, $excludeidfolders = 0) {
    $foldername = mysqli_real_escape_string($mysqli, $foldername);
    $sql = 'select * from folders'
        ." where idusers = $idusers"
        ." and parentidfolders = $parentidfolders"
        ." and foldername = '$foldername'"
        ." and idfolders != $excludeidfolders";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
