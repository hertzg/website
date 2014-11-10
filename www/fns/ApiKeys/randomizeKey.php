<?php

namespace ApiKeys;

function randomizeKey ($mysqli, $id) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $key = openssl_random_pseudo_bytes($maxLengths['key']);
    include_once __DIR__.'/../base62_encode.php';
    $key = substr(base62_encode($key), 0, $maxLengths['key']);

    $sql = "update api_keys set `key` = '$key' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
