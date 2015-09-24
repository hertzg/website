<?php

namespace ApiKeys;

function randomizeKey ($mysqli, $id) {

    include_once __DIR__.'/../ApiKey/random.php';
    $key = \ApiKey\random();

    $sql = "update api_keys set `key` = '$key' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
