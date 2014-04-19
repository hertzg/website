<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table channels add num_users int unsigned not null') || trigger_error($mysqli->error);

include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';

$channels = mysqli_query_object($mysqli, 'select * from channels');
foreach ($channels as $channel) {
    $num_users = mysqli_single_object($mysqli, "select count(*) value from subscribed_channels where id_channels = $channel->id and publisher_locked")->value;
    $mysqli->query("update channels set num_users = $num_users where id = $channel->id") || trigger_error($mysqli->error);
}

echo "Done\n";
