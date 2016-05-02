<?php

namespace Signins;

function add ($mysqli, $id_users, $remote_address, $user_agent) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    if ($user_agent === null) $user_agent = 'null';
    else $user_agent = "'".$mysqli->real_escape_string($user_agent)."'";
    $insert_time = time();

    $sql = 'insert into signins'
        .' (id_users, insert_time, remote_address, user_agent)'
        ." values ($id_users, $insert_time, '$remote_address', $user_agent)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
