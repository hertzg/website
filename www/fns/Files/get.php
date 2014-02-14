<?php

namespace Files;

function get ($mysqli, $idusers, $id) {
    $sql = 'select * from files'
        ." where idusers = $idusers and idfiles = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
