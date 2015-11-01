<?php

namespace AdminConnections;

function get ($mysqli, $id) {
    $sql = "select * from admin_connections where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
