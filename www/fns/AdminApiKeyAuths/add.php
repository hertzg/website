<?php

namespace AdminApiKeyAuths;

function add ($mysqli, $id_admin_api_keys, $remote_address, $method) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    $insert_time = time();

    $sql = 'insert into admin_api_key_auths'
        .' (id_admin_api_keys, remote_address,'
        .' method, insert_time)'
        ." values ($id_admin_api_keys, '$remote_address',"
        ." '$method', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
