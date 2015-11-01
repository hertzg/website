<?php

namespace AdminConnections;

function randomizeOurExchangeApiKey ($mysqli, $id) {

    include_once __DIR__.'/../ApiKey/random.php';
    $our_exchange_api_key = \ApiKey\random();

    $sql = 'update admin_connections set'
        ." our_exchange_api_key = '$our_exchange_api_key' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
