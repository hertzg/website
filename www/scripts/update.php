#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';
include_once '../fns/base62_decode.php';
include_once '../fns/mysqli_query_object.php';

$api_keys = mysqli_query_object($mysqli, 'select * from api_keys');
foreach ($api_keys as $api_key) {
    $key = bin2hex($api_key->key);
    $key = $mysqli->real_escape_string($key);
    $sql = "update api_keys set `key` = '$key' where id = $api_key->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
