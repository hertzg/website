<?php

namespace AdminApiKeys;

function randomizeKey ($mysqli, $id) {

    include_once __DIR__.'/../ApiKey/random.php';
    $key = \ApiKey\random();

    $sql = "update admin_api_keys set `key` = '$key' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
