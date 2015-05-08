#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/ApiKeys/countOnUser.php';
include_once '../fns/BarCharts/countOnUser.php';
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
include_once '../fns/ReceivedBookmarks/countArchivedOnReceiver.php';
include_once '../fns/ReceivedBookmarks/countOnReceiver.php';
include_once '../fns/ReceivedContacts/countArchivedOnReceiver.php';
include_once '../fns/ReceivedContacts/countOnReceiver.php';
include_once '../fns/ReceivedFiles/countArchivedOnReceiver.php';
include_once '../fns/ReceivedFiles/Committed/countOnReceiver.php';
include_once '../fns/ReceivedFolders/countArchivedOnReceiver.php';
include_once '../fns/ReceivedFolders/Committed/countOnReceiver.php';
include_once '../fns/ReceivedNotes/countArchivedOnReceiver.php';
include_once '../fns/ReceivedNotes/countOnReceiver.php';
include_once '../fns/ReceivedPlaces/countArchivedOnReceiver.php';
include_once '../fns/ReceivedPlaces/countOnReceiver.php';
include_once '../fns/ReceivedTasks/countArchivedOnReceiver.php';
include_once '../fns/ReceivedTasks/countOnReceiver.php';
include_once '../fns/Schedules/countOnUser.php';
include_once '../fns/SubscribedChannels/countOnSubscriber.php';
include_once '../fns/Tasks/countOnUser.php';
include_once '../fns/Tokens/countOnUser.php';
include_once '../fns/Users/editNumbers.php';
include_once '../fns/Wallets/countOnUser.php';

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {

    $id_users = $user->id_users;

    $num_api_keys = ApiKeys\countOnUser($mysqli, $id_users);
    $num_archived_received_bookmarks = ReceivedBookmarks\countArchivedOnReceiver(
        $mysqli, $id_users);
    $num_archived_received_contacts = ReceivedContacts\countArchivedOnReceiver(
        $mysqli, $id_users);
    $num_archived_received_files = ReceivedFiles\countArchivedOnReceiver(
        $mysqli, $id_users);
    $num_archived_received_folders = ReceivedFolders\countArchivedOnReceiver(
        $mysqli, $id_users);
    $num_archived_received_notes = ReceivedNotes\countArchivedOnReceiver(
        $mysqli, $id_users);
    $num_archived_received_places = ReceivedPlaces\countArchivedOnReceiver(
        $mysqli, $id_users);
    $num_archived_received_tasks = ReceivedTasks\countArchivedOnReceiver(
        $mysqli, $id_users);
    $num_bar_charts = BarCharts\countOnUser($mysqli, $id_users);
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

    Users\editNumbers($mysqli, $id_users, $num_api_keys,
        $num_archived_received_bookmarks, $num_archived_received_contacts,
        $num_archived_received_files, $num_archived_received_folders,
        $num_archived_received_notes, $num_archived_received_places,
        $num_archived_received_tasks, $num_bar_charts, $num_bookmarks,
        $num_channels, $num_connections, $num_contacts, $num_deleted_items,
        $num_events, $num_folders, $num_notes, $num_notifications, $num_places,
        $num_received_bookmarks, $num_received_contacts, $num_received_files,
        $num_received_folders, $num_received_notes, $num_received_places,
        $num_received_tasks, $num_schedules, $num_subscribed_channels,
        $num_tasks, $num_tokens, $num_wallets);

}

include_once '../fns/Channels/editNumbers.php';
include_once '../fns/Notifications/countOnChannel.php';
include_once '../fns/SubscribedChannels/countPublisherLockedOnChannel.php';

$channels = mysqli_query_object($mysqli, 'select * from channels');
foreach ($channels as $channel) {
    $id = $channel->id;
    $num_notifications = Notifications\countOnChannel($mysqli, $id);
    $num_users = SubscribedChannels\countPublisherLockedOnChannel(
        $mysqli, $id);
    Channels\editNumbers($mysqli, $id, $num_notifications, $num_users);
}

include_once '../fns/Notifications/countOnSubscribedChannel.php';
include_once '../fns/SubscribedChannels/editNumbers.php';

$sql = 'select * from subscribed_channels';
$subscribed_channels = mysqli_query_object($mysqli, $sql);
foreach ($subscribed_channels as $subscribed_channel) {
    $id = $subscribed_channel->id;
    $num_notifications = Notifications\countOnSubscribedChannel($mysqli, $id);
    SubscribedChannels\editNumbers($mysqli, $id, $num_notifications);
}

include_once '../fns/WalletTransactions/countOnWallet.php';
include_once '../fns/Wallets/editNumbers.php';

$wallets = mysqli_query_object($mysqli, 'select * from wallets');
foreach ($wallets as $wallet) {
    $id = $wallet->id;
    $num_transactions = WalletTransactions\countOnWallet($mysqli, $id);
    Wallets\editNumbers($mysqli, $id, $num_transactions);
}

include_once '../fns/PlacePoints/countOnPlace.php';
include_once '../fns/Places/editNumbers.php';

$places = mysqli_query_object($mysqli, 'select * from places');
foreach ($places as $place) {
    $id = $place->id;
    $num_transactions = PlacePoints\countOnPlace($mysqli, $id);
    Places\editNumbers($mysqli, $id, $num_transactions);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
