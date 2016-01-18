<?php

namespace Users\Account\Close;

function deleteBookmarks ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_bookmarks) {

        include_once "$fnsDir/Bookmarks/deleteOnUser.php";
        \Bookmarks\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/BookmarkTags/deleteOnUser.php";
        \BookmarkTags\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/BookmarkRevisions/deleteOnUser.php";
        \BookmarkRevisions\deleteOnUser($mysqli, $id_users);

    }

    if ($user->num_received_bookmarks) {
        include_once "$fnsDir/ReceivedBookmarks/deleteOnReceiver.php";
        \ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);
    }

}
