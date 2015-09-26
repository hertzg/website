<?php

namespace AdminApiKeys;

function get ($mysqli, $id) {
    $sql = "select * from admin_api_keys where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
