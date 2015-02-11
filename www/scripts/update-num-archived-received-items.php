#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');

include_once '../fns/ReceivedBookmarks/countArchivedOnReceiver.php';
include_once '../fns/ReceivedContacts/countArchivedOnReceiver.php';
include_once '../fns/ReceivedFiles/countArchivedOnReceiver.php';
include_once '../fns/ReceivedFolders/countArchivedOnReceiver.php';
include_once '../fns/ReceivedNotes/countArchivedOnReceiver.php';
include_once '../fns/ReceivedPlaces/countArchivedOnReceiver.php';
include_once '../fns/ReceivedTasks/countArchivedOnReceiver.php';

foreach ($users as $user) {

    $id_users = $user->id_users;

    $bookmarks = ReceivedBookmarks\countArchivedOnReceiver($mysqli, $id_users);
    $contacts = ReceivedContacts\countArchivedOnReceiver($mysqli, $id_users);
    $files = ReceivedFiles\countArchivedOnReceiver($mysqli, $id_users);
    $folders = ReceivedFolders\countArchivedOnReceiver($mysqli, $id_users);
    $notes = ReceivedNotes\countArchivedOnReceiver($mysqli, $id_users);
    $places = ReceivedPlaces\countArchivedOnReceiver($mysqli, $id_users);
    $tasks = ReceivedTasks\countArchivedOnReceiver($mysqli, $id_users);

    $sql = 'update users set'
        ." num_archived_received_bookmarks = $bookmarks,"
        ." num_archived_received_contacts = $contacts,"
        ." num_archived_received_files = $files,"
        ." num_archived_received_notes = $notes,"
        ." num_archived_received_places = $places,"
        ." num_archived_received_tasks = $tasks"
        ." where id_users = $id_users";

    $mysqli->query($sql) || die($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
