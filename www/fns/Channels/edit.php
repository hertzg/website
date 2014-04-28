<?php

namespace Channels;

function edit ($mysqli, $id, $channel_name, $public) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $public = $public ? '1' : '0';

    $sql = "update channels set channel_name = '$channel_name',"
        ." public = $public where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
