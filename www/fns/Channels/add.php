<?php

namespace Channels;

function add ($mysqli, $id_users, $channel_name) {
    $channel_name = $mysqli->real_escape_string($channel_name);
    $channel_key = $mysqli->real_escape_string(md5(uniqid(), true));
    $sql = 'insert into channels (id_users, channel_name, channel_key)'
        ." values ($id_users, '$channel_name', '$channel_key')";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
