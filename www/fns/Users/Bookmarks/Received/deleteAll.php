<?php

namespace Users\Bookmarks\Received;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedBookmarks/indexOnReceiver.php";
    $receivedBookmarks = \ReceivedBookmarks\indexOnReceiver($mysqli, $id_users);

    if ($receivedBookmarks) {
        include_once __DIR__.'/../../DeletedItems/addReceivedBookmark.php';
        foreach ($receivedBookmarks as $receivedBookmark) {
            \Users\DeletedItems\addReceivedBookmark($mysqli, $receivedBookmark);
        }
    }

    include_once "$fnsDir/ReceivedBookmarks/deleteOnReceiver.php";
    \ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_bookmarks = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
