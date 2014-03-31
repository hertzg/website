#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $id_users = $user->id_users;

    $sql = "select count(*) value from bookmarks where id_users = $id_users";
    $num_bookmarks = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from channels where id_users = $id_users";
    $num_channels = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from contacts where id_users = $id_users";
    $num_contacts = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from events where id_users = $id_users";
    $num_events = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from notifications where id_users = $id_users";
    $num_notifications = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from notes where id_users = $id_users";
    $num_notes = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from tasks where id_users = $id_users";
    $num_tasks = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from tokens where id_users = $id_users";
    $num_tokens = mysqli_single_object($mysqli, $sql)->value;

    $sql = "update users set num_bookmarks = $num_bookmarks,"
        ." num_channels = $num_channels, num_contacts = $num_contacts,"
        ." num_events = $num_events, num_notes = $num_notes,"
        ." num_tasks = $num_tasks, num_tokens = $num_tokens"
        ." where id_users = $id_users";
    $mysqli->query($sql) || die($mysqli->error);

}

$channels = mysqli_query_object($mysqli, 'select * from channels');
foreach ($channels as $channel) {

    $id_channels = $channel->id_channels;

    $sql = "select count(*) value from notifications where id_channels = $id_channels";
    $num_notifications = mysqli_single_object($mysqli, $sql)->value;

    $sql = "update channels set num_notifications = $num_notifications"
        ." where id_channels = $id_channels";
    $mysqli->query($sql) || die($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
