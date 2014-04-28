<?php

namespace Channels;

function getByName ($mysqli, $channel_name, $exclude_id = 0) {
    $channel_name = $mysqli->real_escape_string($channel_name);
    $sql = "select * from channels where channel_name = '$channel_name'"
        ." and id != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
