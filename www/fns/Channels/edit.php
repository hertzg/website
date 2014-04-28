<?php

namespace Channels;

function edit ($mysqli, $id, $channel_name, $public) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $public = $public ? '1' : '0';
    $update_time = time();

    $sql = "update channels set channel_name = '$channel_name',"
        ." public = $public, update_time = $update_time where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
