<?php

namespace Wallets;

function add ($mysqli, $id_users, $name) {

    $name = $mysqli->real_escape_string($name);
    $insert_time = $update_time = time();

    $sql = 'insert into wallets (id_users, name, insert_time, update_time)'
        ." values ($id_users, '$name', $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
