<?php

namespace Users;

function updateNumbers ($mysqli) {

    include_once __DIR__.'/index.php';
    $users = index($mysqli);

    if (!$users) return;

    $fnsDir = __DIR__.'/..';

    include_once __DIR__.'/editNumbers.php';
    include_once "$fnsDir/ApiKeys/countOnUser.php";
    include_once "$fnsDir/BarCharts/countOnUser.php";
    include_once "$fnsDir/Bookmarks/countOnUser.php";
    include_once "$fnsDir/Channels/countOnUser.php";
    include_once "$fnsDir/Connections/countOnUser.php";
    include_once "$fnsDir/Contacts/countOnUser.php";
    include_once "$fnsDir/DeletedItems/countOnUser.php";
    include_once "$fnsDir/Events/countOnUser.php";
    include_once "$fnsDir/Files/Committed/countOnUser.php";
    include_once "$fnsDir/Folders/countOnUser.php";
    include_once "$fnsDir/Notes/countOnUser.php";
    include_once "$fnsDir/Notes/countPasswordProtectedOnUser.php";
    include_once "$fnsDir/Notifications/countOnUser.php";
    include_once "$fnsDir/Places/countOnUser.php";
    include_once "$fnsDir/ReceivedBookmarks/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedBookmarks/countOnReceiver.php";
    include_once "$fnsDir/ReceivedContacts/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedContacts/countOnReceiver.php";
    include_once "$fnsDir/ReceivedFiles/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedFiles/Committed/countOnReceiver.php";
    include_once "$fnsDir/ReceivedFolders/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedFolders/Committed/countOnReceiver.php";
    include_once "$fnsDir/ReceivedNotes/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedNotes/countOnReceiver.php";
    include_once "$fnsDir/ReceivedPlaces/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedPlaces/countOnReceiver.php";
    include_once "$fnsDir/ReceivedSchedules/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedSchedules/countOnReceiver.php";
    include_once "$fnsDir/ReceivedTasks/countArchivedOnReceiver.php";
    include_once "$fnsDir/ReceivedTasks/countOnReceiver.php";
    include_once "$fnsDir/Schedules/countOnUser.php";
    include_once "$fnsDir/SubscribedChannels/countOnSubscriber.php";
    include_once "$fnsDir/Tasks/countOnUser.php";
    include_once "$fnsDir/Tokens/countOnUser.php";
    include_once "$fnsDir/Users/editNumbers.php";
    include_once "$fnsDir/Wallets/countOnUser.php";
    foreach ($users as $user) {

        $id_users = $user->id_users;

        $num_api_keys = \ApiKeys\countOnUser($mysqli, $id_users);
        $num_archived_received_bookmarks =
            \ReceivedBookmarks\countArchivedOnReceiver($mysqli, $id_users);
        $num_archived_received_contacts =
            \ReceivedContacts\countArchivedOnReceiver($mysqli, $id_users);
        $num_archived_received_files =
            \ReceivedFiles\countArchivedOnReceiver($mysqli, $id_users);
        $num_archived_received_folders =
            \ReceivedFolders\countArchivedOnReceiver($mysqli, $id_users);
        $num_archived_received_notes =
            \ReceivedNotes\countArchivedOnReceiver($mysqli, $id_users);
        $num_archived_received_places =
            \ReceivedPlaces\countArchivedOnReceiver($mysqli, $id_users);
        $num_archived_received_schedules =
            \ReceivedSchedules\countArchivedOnReceiver($mysqli, $id_users);
        $num_archived_received_tasks =
            \ReceivedTasks\countArchivedOnReceiver($mysqli, $id_users);
        $num_bar_charts = \BarCharts\countOnUser($mysqli, $id_users);
        $num_bookmarks = \Bookmarks\countOnUser($mysqli, $id_users);
        $num_channels = \Channels\countOnUser($mysqli, $id_users);
        $num_connections = \Connections\countOnUser($mysqli, $id_users);
        $num_contacts = \Contacts\countOnUser($mysqli, $id_users);
        $num_deleted_items = \DeletedItems\countOnUser($mysqli, $id_users);
        $num_events = \Events\countOnUser($mysqli, $id_users);
        $num_files = \Files\Committed\countOnUser($mysqli, $id_users);
        $num_folders = \Folders\countOnUser($mysqli, $id_users);
        $num_notes = \Notes\countOnUser($mysqli, $id_users);
        $num_notifications = \Notifications\countOnUser($mysqli, $id_users);
        $num_password_protected_notes =
            \Notes\countPasswordProtectedOnUser($mysqli, $id_users);
        $num_places = \Places\countOnUser($mysqli, $id_users);
        $num_received_bookmarks =
            \ReceivedBookmarks\countOnReceiver($mysqli, $id_users);
        $num_received_contacts =
            \ReceivedContacts\countOnReceiver($mysqli, $id_users);
        $num_received_files =
            \ReceivedFiles\Committed\countOnReceiver($mysqli, $id_users);
        $num_received_folders =
            \ReceivedFolders\Committed\countOnReceiver($mysqli, $id_users);
        $num_received_notes =
            \ReceivedNotes\countOnReceiver($mysqli, $id_users);
        $num_received_places =
            \ReceivedPlaces\countOnReceiver($mysqli, $id_users);
        $num_received_schedules =
            \ReceivedSchedules\countOnReceiver($mysqli, $id_users);
        $num_received_tasks =
            \ReceivedTasks\countOnReceiver($mysqli, $id_users);
        $num_schedules = \Schedules\countOnUser($mysqli, $id_users);
        $num_subscribed_channels =
            \SubscribedChannels\countOnSubscriber($mysqli, $id_users);
        $num_tasks = \Tasks\countOnUser($mysqli, $id_users);
        $num_tokens = \Tokens\countOnUser($mysqli, $id_users);
        $num_wallets = \Wallets\countOnUser($mysqli, $id_users);

        editNumbers($mysqli, $id_users, $num_api_keys,
            $num_archived_received_bookmarks,
            $num_archived_received_contacts,
            $num_archived_received_files, $num_archived_received_folders,
            $num_archived_received_notes, $num_archived_received_places,
            $num_archived_received_schedules, $num_archived_received_tasks,
            $num_bar_charts, $num_bookmarks, $num_channels,
            $num_connections, $num_contacts, $num_deleted_items,
            $num_events, $num_files, $num_folders, $num_notes,
            $num_notifications, $num_password_protected_notes,
            $num_places, $num_received_bookmarks,
            $num_received_contacts, $num_received_files,
            $num_received_folders, $num_received_notes,
            $num_received_places, $num_received_schedules,
            $num_received_tasks, $num_schedules, $num_subscribed_channels,
            $num_tasks, $num_tokens, $num_wallets);

    }

}
