<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$channels = mysqli_query_object($mysqli, 'select * from channels');
foreach ($channels as $channel) {
    $lowercase_name = strtolower($channel->channel_name);
    $lowercase_name = $mysqli->real_escape_string($lowercase_name);
    $sql = "update channels set lowercase_name = '$lowercase_name'"
        ." where id = $channel->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$channels = mysqli_query_object($mysqli, 'select * from subscribed_channels');
foreach ($channels as $channel) {
    $lowercase_name = strtolower($channel->channel_name);
    $lowercase_name = $mysqli->real_escape_string($lowercase_name);
    $sql = "update subscribed_channels set lowercase_name = '$lowercase_name'"
        ." where id = $channel->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
