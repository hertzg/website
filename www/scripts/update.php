<?php

include_once '../lib/mysqli.php';

$sql = 'alter table users'
    .' add num_bookmarks bigint unsigned not null,'
    .' add num_channels bigint unsigned not null,'
    .' add num_contacts bigint unsigned not null,'
    .' add num_events bigint unsigned not null,'
    .' add num_notes bigint unsigned not null,'
    .' add num_tasks bigint unsigned not null,'
    .' add num_tokens bigint unsigned not null';
$mysqli->query($sql);

include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';

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
    $mysqli->query($sql);

}

echo 'Done';
