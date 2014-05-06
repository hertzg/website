<?php

chdir(__DIR__);
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$mysqli->query('update notifications set id_channels = null'
    .' where id_subscribed_channels is not null') || trigger_error($mysqli->error);

$mysqli->query('alter table subscribed_channels'
    .' add num_notifications bigint unsigned not null') || trigger_error($mysqli->error);

$subscribed_channels = mysqli_query_object($mysqli, 'select * from subscribed_channels');
foreach ($subscribed_channels as $subscribed_channel) {
    $id = $subscribed_channel->id;
    $num_notifications = mysqli_single_object($mysqli, 'select count(*) total'
        ." from notifications where id_subscribed_channels = $id")->total;
    $mysqli->query('update subscribed_channels'
        ." set num_notifications = $num_notifications where id = $id") || trigger_error($mysqli->error);
}

$channels = mysqli_query_object($mysqli, 'select * from channels');
foreach ($channels as $channel) {
    $id = $channel->id;
    $num_notifications = mysqli_single_object($mysqli, 'select count(*) total'
        ." from notifications where id_channels = $id")->total;
    $mysqli->query('update channels'
        ." set num_notifications = $num_notifications where id = $id") || trigger_error($mysqli->error);
}

echo "Done\n";
