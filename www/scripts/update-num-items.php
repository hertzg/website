#!/usr/bin/php
<?php

function count_rows ($mysqli, $sql) {
    $sql = "select count(*) value from $sql";
    return mysqli_single_object($mysqli, $sql)->value;
}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

include_once '../fns/ApiKeys/countOnUser.php';
include_once '../fns/Bookmarks/countOnUser.php';
include_once '../fns/Channels/countOnUser.php';
include_once '../fns/Connections/countOnUser.php';
include_once '../fns/Contacts/countOnUser.php';
include_once '../fns/DeletedItems/countOnUser.php';
include_once '../fns/Events/countOnUser.php';
include_once '../fns/Folders/countOnUser.php';
include_once '../fns/Notes/countOnUser.php';
include_once '../fns/Notifications/countOnUser.php';
include_once '../fns/Places/countOnUser.php';
include_once '../fns/ReceivedBookmarks/countOnReceiver.php';
include_once '../fns/ReceivedContacts/countOnReceiver.php';
include_once '../fns/ReceivedFiles/Committed/countOnReceiver.php';
include_once '../fns/ReceivedFolders/Committed/countOnReceiver.php';
include_once '../fns/ReceivedNotes/countOnReceiver.php';
include_once '../fns/ReceivedPlaces/countOnReceiver.php';
include_once '../fns/ReceivedTasks/countOnReceiver.php';
include_once '../fns/Schedules/countOnUser.php';
include_once '../fns/SubscribedChannels/countOnSubscriber.php';
include_once '../fns/Tasks/countOnUser.php';
include_once '../fns/Tokens/countOnUser.php';
include_once '../fns/Wallets/countOnUser.php';

$microtime = microtime(true);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $id_users = $user->id_users;

    $num_api_keys = ApiKeys\countOnUser($mysqli, $id_users);
    $num_bookmarks = Bookmarks\countOnUser($mysqli, $id_users);
    $num_channels = Channels\countOnUser($mysqli, $id_users);
    $num_connections = Connections\countOnUser($mysqli, $id_users);
    $num_contacts = Contacts\countOnUser($mysqli, $id_users);
    $num_deleted_items = DeletedItems\countOnUser($mysqli, $id_users);
    $num_events = Events\countOnUser($mysqli, $id_users);
    $num_folders = Folders\countOnUser($mysqli, $id_users);
    $num_notes = Notes\countOnUser($mysqli, $id_users);
    $num_notifications = Notifications\countOnUser($mysqli, $id_users);
    $num_places = Places\countOnUser($mysqli, $id_users);
    $num_received_bookmarks = ReceivedBookmarks\countOnReceiver(
        $mysqli, $id_users);
    $num_received_contacts = ReceivedContacts\countOnReceiver(
        $mysqli, $id_users);
    $num_received_files = ReceivedFiles\Committed\countOnReceiver(
        $mysqli, $id_users);
    $num_received_folders = ReceivedFolders\Committed\countOnReceiver(
        $mysqli, $id_users);
    $num_received_notes = ReceivedNotes\countOnReceiver($mysqli, $id_users);
    $num_received_places = ReceivedPlaces\countOnReceiver($mysqli, $id_users);
    $num_received_tasks = ReceivedTasks\countOnReceiver($mysqli, $id_users);
    $num_schedules = Schedules\countOnUser($mysqli, $id_users);
    $num_subscribed_channels = SubscribedChannels\countOnSubscriber(
        $mysqli, $id_users);
    $num_tasks = Tasks\countOnUser($mysqli, $id_users);
    $num_tokens = Tokens\countOnUser($mysqli, $id_users);
    $num_wallets = Wallets\countOnUser($mysqli, $id_users);

    $sql = "update users set num_api_keys = $num_api_keys,"
        ." num_bookmarks = $num_bookmarks, num_channels = $num_channels,"
        ." num_connections = $num_connections, num_contacts = $num_contacts,"
        ." num_deleted_items = $num_deleted_items, num_events = $num_events,"
        ." num_folders = $num_folders, num_notes = $num_notes,"
        ." num_notifications = $num_notifications, num_places = $num_places,"
        ." num_received_bookmarks = $num_received_bookmarks,"
        ." num_received_contacts = $num_received_contacts,"
        ." num_received_files = $num_received_files,"
        ." num_received_folders = $num_received_folders,"
        ." num_received_notes = $num_received_notes,"
        ." num_received_places = $num_received_places,"
        ." num_received_tasks = $num_received_tasks, num_places = $num_places,"
        ." num_subscribed_channels = $num_subscribed_channels,"
        ." num_tasks = $num_tasks, num_tokens = $num_tokens,"
        ." num_wallets = $num_wallets where id_users = $id_users";

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
