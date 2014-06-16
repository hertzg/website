<?php

function close_account ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ApiKeys/deleteOnUser.php";
    ApiKeys\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Bookmarks/deleteOnUser.php";
    Bookmarks\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/BookmarkTags/deleteOnUser.php";
    BookmarkTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Channels/deleteOnUser.php";
    Channels\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Connections/deleteContainingUser.php";
    Connections\deleteContainingUser($mysqli, $id_users);

    include_once "$fnsDir/Contacts/deleteOnUser.php";
    Contacts\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ContactTags/deleteOnUser.php";
    ContactTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/DeletedItems/deleteOnUser.php";
    DeletedItems\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Events/deleteOnUser.php";
    Events\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Feedbacks/deleteOnUser.php";
    Feedbacks\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Files/deleteOnUser.php";
    Files\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Folders/deleteOnUser.php";
    Folders\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Notes/deleteOnUser.php";
    Notes\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/NoteTags/deleteOnUser.php";
    NoteTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Notifications/deleteOnUser.php";
    Notifications\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ReceivedBookmarks/deleteOnReceiver.php";
    ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedContacts/deleteOnReceiver.php";
    ReceivedContacts\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedFiles/deleteOnReceiver.php";
    ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedNotes/deleteOnReceiver.php";
    ReceivedNotes\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedTasks/deleteOnReceiver.php";
    ReceivedTasks\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/Schedules/deleteOnUser.php";
    Schedules\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/SubscribedChannels/deleteContainingUser.php";
    SubscribedChannels\deleteContainingUser($mysqli, $id_users);

    include_once "$fnsDir/Tasks/deleteOnUser.php";
    Tasks\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/TaskTags/deleteOnUser.php";
    TaskTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Tokens/deleteOnUser.php";
    Tokens\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Users/delete.php";
    Users\delete($mysqli, $id_users);

}
