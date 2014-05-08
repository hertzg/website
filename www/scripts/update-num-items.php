#!/usr/bin/php
<?php

function mysqli_count ($mysqli, $sql) {
    $sql = "select count(*) value from $sql";
    return mysqli_single_object($mysqli, $sql)->value;
}

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $id_users = $user->id_users;

    $sql = "bookmarks where id_users = $id_users";
    $num_bookmarks = mysqli_count($mysqli, $sql);

    $sql = "channels where id_users = $id_users";
    $num_channels = mysqli_count($mysqli, $sql);

    $sql = "connections where id_users = $id_users";
    $num_connections = mysqli_count($mysqli, $sql);

    $sql = "contacts where id_users = $id_users";
    $num_contacts = mysqli_count($mysqli, $sql);

    $sql = "events where id_users = $id_users";
    $num_events = mysqli_count($mysqli, $sql);

    $sql = "notes where id_users = $id_users";
    $num_notes = mysqli_count($mysqli, $sql);

    $sql = 'notifications'
        ." where id_users = $id_users";
    $num_notifications = mysqli_count($mysqli, $sql);

    $sql = "received_bookmarks where receiver_id_users = $id_users";
    $num_received_bookmarks = mysqli_count($mysqli, $sql);

    $sql = "received_contacts where receiver_id_users = $id_users";
    $num_received_contacts = mysqli_count($mysqli, $sql);

    $sql = "received_files where receiver_id_users = $id_users";
    $num_received_files = mysqli_count($mysqli, $sql);

    $sql = "received_notes where receiver_id_users = $id_users";
    $num_received_notes = mysqli_count($mysqli, $sql);

    $sql = "received_tasks where receiver_id_users = $id_users";
    $num_received_tasks = mysqli_count($mysqli, $sql);

    $sql = "schedules where id_users = $id_users";
    $num_schedules = mysqli_count($mysqli, $sql);

    $sql = "tasks where id_users = $id_users";
    $num_tasks = mysqli_count($mysqli, $sql);

    $sql = "tokens where id_users = $id_users";
    $num_tokens = mysqli_count($mysqli, $sql);

    $sql = "update users set num_bookmarks = $num_bookmarks,"
        ." num_channels = $num_channels, num_connections = $num_connections,"
        ." num_contacts = $num_contacts, num_events = $num_events,"
        ." num_notes = $num_notes, num_notifications = $num_notifications,"
        ." num_received_bookmarks = $num_received_bookmarks,"
        ." num_received_contacts = $num_received_contacts,"
        ." num_received_files = $num_received_files,"
        ." num_received_notes = $num_received_notes,"
        ." num_received_tasks = $num_received_tasks,"
        ." num_tasks = $num_tasks, num_tokens = $num_tokens"
        ." where id_users = $id_users";
    $mysqli->query($sql) || die($mysqli->error);

}

$channels = mysqli_query_object($mysqli, 'select * from channels');
foreach ($channels as $channel) {

    $id = $channel->id;

    $sql = "notifications where id_channels = $id";
    $num_notifications = mysqli_count($mysqli, $sql);

    $sql = 'update channels set'
        ." num_notifications = $num_notifications where id = $id";
    $mysqli->query($sql) || die($mysqli->error);

}

$subscribed_channels = mysqli_query_object($mysqli, 'select * from subscribed_channels');
foreach ($subscribed_channels as $subscribed_channel) {

    $id = $subscribed_channel->id;

    $sql = "notifications where id_subscribed_channels = $id";
    $num_notifications = mysqli_count($mysqli, $sql);

    $sql = 'update subscribed_channels set'
        ." num_notifications = $num_notifications where id = $id";
    $mysqli->query($sql) || die($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
