<?php

namespace Signins;

function add ($mysqli, $id_users, $remote_address) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    $insert_time = time();

    $sql = 'insert into signins (id_users, insert_time, remote_address)'
        ." values ($id_users, $insert_time, '$remote_address')";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
