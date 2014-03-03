#!/usr/bin/php
<?php

include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $idusers = $user->idusers;

    $sql = "select count(*) value from bookmarks where idusers = $idusers";
    $num_bookmarks = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from channels where idusers = $idusers";
    $num_channels = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from contacts where idusers = $idusers";
    $num_contacts = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from events where idusers = $idusers";
    $num_events = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from notifications where idusers = $idusers";
    $num_notifications = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from notes where idusers = $idusers";
    $num_notes = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from tasks where idusers = $idusers";
    $num_tasks = mysqli_single_object($mysqli, $sql)->value;

    $sql = "select count(*) value from tokens where idusers = $idusers";
    $num_tokens = mysqli_single_object($mysqli, $sql)->value;

    $sql = 'update users set'
        ." num_bookmarks = $num_bookmarks,"
        ." num_channels = $num_channels,"
        ." num_contacts = $num_contacts,"
        ." num_events = $num_events,"
        ." num_notes = $num_notes,"
        ." num_tasks = $num_tasks,"
        ." num_tokens = $num_tokens"
        ." where idusers = $idusers";
    $mysqli->query($sql) || die($mysqli->error);

}

$channels = mysqli_query_object($mysqli, 'select * from channels');
foreach ($channels as $channel) {

    $idchannels = $channel->idchannels;

    $sql = "select count(*) value from notifications where idchannels = $idchannels";
    $num_notifications = mysqli_single_object($mysqli, $sql)->value;

    $sql = "update channels set num_notifications = $num_notifications"
        ." where idchannels = $idchannels";
    $mysqli->query($sql) || die($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
