<?php

namespace Notes;

function get ($mysqli, $idusers, $id) {
    $sql = 'select * from notes'
        ." where idusers = $idusers and idnotes = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
