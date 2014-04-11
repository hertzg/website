<?php

namespace ReceivedFiles;

function get ($mysqli, $id) {
    $sql = "select * from received_files where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
