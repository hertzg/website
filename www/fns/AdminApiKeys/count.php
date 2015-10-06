<?php

namespace AdminApiKeys;

function count ($mysqli) {
    $sql = 'select count(*) total from admin_api_keys';
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->total;
}
