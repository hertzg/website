<?php

namespace Tokens;

function editAccess ($mysqli, $id,
    $access_time, $remote_address, $user_agent) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    if ($user_agent === null) $user_agent = 'null';
    else $user_agent = "'".$mysqli->real_escape_string($user_agent)."'";

    $sql = "update tokens set access_time = $access_time,"
        ." access_remote_address = '$remote_address',"
        ." user_agent = $user_agent where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
