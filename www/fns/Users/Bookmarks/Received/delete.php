<?php

namespace Users\Bookmarks\Received;

function delete ($mysqli, $receivedBookmark) {

    include_once __DIR__.'/../../../ReceivedBookmarks/delete.php';
    \ReceivedBookmarks\delete($mysqli, $receivedBookmark->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receivedBookmark->receiver_id_users, -1);

    include_once __DIR__.'/../../DeletedItems/addReceivedBookmark.php';
    \Users\DeletedItems\addReceivedBookmark($mysqli, $receivedBookmark);

}
