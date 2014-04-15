<?php

namespace Channels;

function add ($mysqli, $id_users, $channel_name, $public) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $channel_key = $mysqli->real_escape_string(md5(uniqid(), true));
    $public = $public ? '1' : '0';

    $sql = 'insert into channels (id_users, channel_name, channel_key, public)'
        ." values ($id_users, '$channel_name', '$channel_key', $public)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
