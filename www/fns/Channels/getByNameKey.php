<?php

namespace Channels;

function getByNameKey ($mysqli, $channel_name, $channel_key) {
    $channel_name = $mysqli->real_escape_string($channel_name);
    $channel_key = $mysqli->real_escape_string($channel_key);
    $sql = 'select * from channels'
        ." where channel_name = '$channel_name'"
        ." and channel_key = '$channel_key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
