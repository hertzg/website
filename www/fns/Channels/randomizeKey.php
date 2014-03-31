<?php

namespace Channels;

function randomizeKey ($mysqli, $id_users, $id) {
    $channel_key = $mysqli->real_escape_string(md5(uniqid(), true));
    $sql = "update channels set channel_key = '$channel_key'"
        ." where id_users = $id_users and id_channels = $id";
    $mysqli->query($sql);
}
