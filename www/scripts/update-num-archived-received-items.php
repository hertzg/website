#!/usr/bin/php
<?php

function count_rows ($mysqli, $table, $id_users) {
    $sql = "select count(*) value from received_$table where archived = 1"
        ." and receiver_id_users = $id_users";
    return mysqli_single_object($mysqli, $sql)->value;
}

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');

include_once '../fns/mysqli_single_object.php';
foreach ($users as $user) {

    $id_users = $user->id_users;

    $bookmarks = count_rows($mysqli, 'bookmarks', $id_users);
    $contacts = count_rows($mysqli, 'contacts', $id_users);
    $files = count_rows($mysqli, 'files', $id_users);
    $notes = count_rows($mysqli, 'notes', $id_users);
    $tasks = count_rows($mysqli, 'tasks', $id_users);

    $sql = 'update users set'
        ." num_archived_received_bookmarks = $bookmarks,"
        ." num_archived_received_contacts = $contacts,"
        ." num_archived_received_files = $files,"
        ." num_archived_received_notes = $notes,"
        ." num_archived_received_tasks = $tasks"
        ." where id_users = $id_users";
    $mysqli->query($sql) || die($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
