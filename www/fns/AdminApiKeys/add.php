<?php

namespace AdminApiKeys;

function add ($mysqli, $name) {

    include_once __DIR__.'/../ApiKey/random.php';
    $key = \ApiKey\random();

    $name = $mysqli->real_escape_string($name);
    $insert_time = time();

    $sql = 'insert into admin_api_keys (`key`, name, insert_time)'
        ." values ('$key', '$name', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
