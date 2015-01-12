<?php

namespace Table;

function ensureAll ($mysqli) {

    $fnsDir = __DIR__.'/..';
    $output = '';

    include_once "$fnsDir/ApiKeys/ensure.php";
    $output .= \ApiKeys\ensure($mysqli);

    include_once "$fnsDir/Bookmarks/ensure.php";
    $output .= \Bookmarks\ensure($mysqli);

    include_once "$fnsDir/BookmarkTags/ensure.php";
    $output .= \BookmarkTags\ensure($mysqli);

    include_once "$fnsDir/Channels/ensure.php";
    $output .= \Channels\ensure($mysqli);

    include_once "$fnsDir/Connections/ensure.php";
    $output .= \Connections\ensure($mysqli);

    include_once "$fnsDir/ContactPhotos/ensure.php";
    $output .= \ContactPhotos\ensure($mysqli);

    include_once "$fnsDir/Contacts/ensure.php";
    $output .= \Contacts\ensure($mysqli);

    include_once "$fnsDir/ContactTags/ensure.php";
    $output .= \ContactTags\ensure($mysqli);

    include_once "$fnsDir/DeletedFiles/ensure.php";
    $output .= \DeletedFiles\ensure($mysqli);

    include_once "$fnsDir/DeletedFolders/ensure.php";
    $output .= \DeletedFolders\ensure($mysqli);

    include_once "$fnsDir/DeletedItems/ensure.php";
    $output .= \DeletedItems\ensure($mysqli);

    include_once "$fnsDir/Events/ensure.php";
    $output .= \Events\ensure($mysqli);

    include_once "$fnsDir/Feedbacks/ensure.php";
    $output .= \Feedbacks\ensure($mysqli);

    include_once "$fnsDir/Files/ensure.php";
    $output .= \Files\ensure($mysqli);

    include_once "$fnsDir/Folders/ensure.php";
    $output .= \Folders\ensure($mysqli);

    include_once "$fnsDir/InvalidSignins/ensure.php";
    $output .= \InvalidSignins\ensure($mysqli);

    include_once "$fnsDir/Notes/ensure.php";
    $output .= \Notes\ensure($mysqli);

    include_once "$fnsDir/NoteTags/ensure.php";
    $output .= \NoteTags\ensure($mysqli);

    include_once "$fnsDir/Notifications/ensure.php";
    $output .= \Notifications\ensure($mysqli);

    include_once "$fnsDir/ReceivedBookmarks/ensure.php";
    $output .= \ReceivedBookmarks\ensure($mysqli);

    include_once "$fnsDir/ReceivedContacts/ensure.php";
    $output .= \ReceivedContacts\ensure($mysqli);

    include_once "$fnsDir/ReceivedFiles/ensure.php";
    $output .= \ReceivedFiles\ensure($mysqli);

    include_once "$fnsDir/ReceivedFolderFiles/ensure.php";
    $output .= \ReceivedFolderFiles\ensure($mysqli);

    include_once "$fnsDir/ReceivedFolders/ensure.php";
    $output .= \ReceivedFolders\ensure($mysqli);

    include_once "$fnsDir/ReceivedFolderSubfolders/ensure.php";
    $output .= \ReceivedFolderSubfolders\ensure($mysqli);

    include_once "$fnsDir/ReceivedNotes/ensure.php";
    $output .= \ReceivedNotes\ensure($mysqli);

    include_once "$fnsDir/ReceivedTasks/ensure.php";
    $output .= \ReceivedTasks\ensure($mysqli);

    include_once "$fnsDir/Schedules/ensure.php";
    $output .= \Schedules\ensure($mysqli);

    include_once "$fnsDir/ScheduleTags/ensure.php";
    $output .= \ScheduleTags\ensure($mysqli);

    include_once "$fnsDir/SubscribedChannels/ensure.php";
    $output .= \SubscribedChannels\ensure($mysqli);

    include_once "$fnsDir/Tasks/ensure.php";
    $output .= \Tasks\ensure($mysqli);

    include_once "$fnsDir/TaskTags/ensure.php";
    $output .= \TaskTags\ensure($mysqli);

    include_once "$fnsDir/Tokens/ensure.php";
    $output .= \Tokens\ensure($mysqli);

    include_once "$fnsDir/Users/ensure.php";
    $output .= \Users\ensure($mysqli);

    include_once "$fnsDir/Wallets/ensure.php";
    $output .= \Wallets\ensure($mysqli);

    include_once "$fnsDir/WalletTransactions/ensure.php";
    $output .= \WalletTransactions\ensure($mysqli);

    return $output;

}
