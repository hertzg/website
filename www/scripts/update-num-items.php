#!/usr/bin/php
<?php

function committed_receiver_user_rows ($mysqli, $table, $id_users) {
    $sql = "$table where committed = 1 and receiver_id_users = $id_users";
    return count_rows($mysqli, $sql);
}

function count_rows ($mysqli, $sql) {
    $sql = "select count(*) value from $sql";
    return mysqli_single_object($mysqli, $sql)->value;
}

function receiver_user_rows ($mysqli, $table, $id_users) {
    return count_rows($mysqli, "$table where receiver_id_users = $id_users");
}

function user_rows ($mysqli, $table, $id_users) {
    return count_rows($mysqli, "$table where id_users = $id_users");
}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $id_users = $user->id_users;

    $num_api_keys = user_rows($mysqli, 'api_keys', $id_users);
    $num_bookmarks = user_rows($mysqli, 'bookmarks', $id_users);
    $num_channels = user_rows($mysqli, 'channels', $id_users);
    $num_connections = user_rows($mysqli, 'connections', $id_users);
    $num_contacts = user_rows($mysqli, 'contacts', $id_users);
    $num_deleted_items = user_rows($mysqli, 'deleted_items', $id_users);
    $num_events = user_rows($mysqli, 'events', $id_users);
    $num_folders = user_rows($mysqli, 'folders', $id_users);
    $num_notes = user_rows($mysqli, 'notes', $id_users);
    $num_notifications = user_rows($mysqli, 'notifications', $id_users);
    $num_received_bookmarks = receiver_user_rows(
        $mysqli, 'received_bookmarks', $id_users);
    $num_received_contacts = receiver_user_rows(
        $mysqli, 'received_contacts', $id_users);
    $num_received_files = committed_receiver_user_rows(
        $mysqli, 'received_files', $id_users);
    $num_received_folders = committed_receiver_user_rows(
        $mysqli, 'received_folders', $id_users);
    $num_received_notes = receiver_user_rows(
        $mysqli, 'received_notes', $id_users);
    $num_received_tasks = receiver_user_rows(
        $mysqli, 'received_tasks', $id_users);
    $num_schedules = user_rows($mysqli, 'schedules', $id_users);
    $num_tasks = user_rows($mysqli, 'tasks', $id_users);
    $num_tokens = user_rows($mysqli, 'tokens', $id_users);

    $sql = "update users set num_api_keys = $num_api_keys,"
        ." num_bookmarks = $num_bookmarks, num_channels = $num_channels,"
        ." num_connections = $num_connections, num_contacts = $num_contacts,"
        ." num_deleted_items = $num_deleted_items, num_events = $num_events,"
        ." num_folders = $num_folders, num_notes = $num_notes,"
        ." num_notifications = $num_notifications,"
        ." num_received_bookmarks = $num_received_bookmarks,"
        ." num_received_contacts = $num_received_contacts,"
        ." num_received_files = $num_received_files,"
        ." num_received_folders = $num_received_folders,"
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
    $num_notifications = count_rows($mysqli, $sql);

    $sql = 'update channels set'
        ." num_notifications = $num_notifications where id = $id";
    $mysqli->query($sql) || die($mysqli->error);

}

$sql = 'select * from subscribed_channels';
$subscribed_channels = mysqli_query_object($mysqli, $sql);
foreach ($subscribed_channels as $subscribed_channel) {

    $id = $subscribed_channel->id;

    $sql = "notifications where id_subscribed_channels = $id";
    $num_notifications = count_rows($mysqli, $sql);

    $sql = 'update subscribed_channels set'
        ." num_notifications = $num_notifications where id = $id";
    $mysqli->query($sql) || die($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
