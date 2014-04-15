<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table channels add public tinyint not null after channel_key');
$mysqli->query('alter table subscribed_channels add public_subscriber tinyint not null');
$mysqli->query('alter table channels add username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL after id_users');

include_once '../fns/mysqli_query_object.php';
$channels = mysqli_query_object($mysqli, 'select * from channels');

include_once '../fns/mysqli_single_object.php';
foreach ($channels as $channel) {
    $username = mysqli_single_object($mysqli, "select * from users where id_users = $channel->id_users")->username;
    $mysqli->query("update channels set username = '$username' where id = $channel->id");
}
