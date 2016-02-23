<?php

namespace AdminConnectionAuths;

function add ($mysqli, $id_admin_connections, $remote_address, $method) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    $insert_time = time();

    $sql = 'insert into admin_connection_auths'
        .' (id_admin_connections, remote_address,'
        .' method, insert_time)'
        ." values ($id_admin_connections, '$remote_address',"
        ." '$method', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
