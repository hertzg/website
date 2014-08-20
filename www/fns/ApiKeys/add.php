<?php

namespace ApiKeys;

function add ($mysqli, $id_users, $name, $expire_time) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $key = openssl_random_pseudo_bytes($maxLengths['key']);
    $key = $mysqli->real_escape_string($key);
    $name = $mysqli->real_escape_string($name);
    if ($expire_time === null) $expire_time = 'null';
    $insert_time = time();

    $sql = "insert into api_keys (id_users, `key`, name, expire_time, insert_time)"
        ." values ($id_users, '$key', '$name', $expire_time, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
