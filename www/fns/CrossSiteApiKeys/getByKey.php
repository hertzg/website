<?php

namespace CrossSiteApiKeys;

function getByKey ($mysqli, $key) {
    $key = $mysqli->real_escape_string($key);
    $sql = "select * from cross_site_api_keys where `key` = '$key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
