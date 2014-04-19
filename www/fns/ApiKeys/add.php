<?php

namespace ApiKeys;

function add ($mysqli, $id_users, $name) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $key = openssl_random_pseudo_bytes($maxLengths['key']);
    $key = $mysqli->real_escape_string($key);
    $name = $mysqli->real_escape_string($name);
    $insert_time = time();

    $sql = "insert into api_keys (id_users, key, name, insert_time)"
        ." values ($id_users, '$key', '$name', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
