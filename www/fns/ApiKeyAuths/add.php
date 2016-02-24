<?php

namespace ApiKeyAuths;

function add ($mysqli, $id_api_keys, $id_users, $remote_address, $method) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    $insert_time = time();

    $sql = 'insert into api_key_auths'
        .' (id_api_keys, id_users,'
        .' remote_address, method, insert_time)'
        ." values ($id_api_keys, $id_users,"
        ." '$remote_address', '$method', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
