<?php

namespace Files;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from files where id_files = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $file = mysqli_single_object($mysqli, $sql);
    if ($file && $file->id_users == $id_users) return $file;
}
