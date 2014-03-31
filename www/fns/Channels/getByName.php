<?php

namespace Channels;

function getByName ($mysqli, $id_users, $channel_name) {
    $channel_name = $mysqli->real_escape_string($channel_name);
    $sql = 'select * from channels'
        ." where id_users = $id_users and channel_name = '$channel_name'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
