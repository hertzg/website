<?php

namespace Users\Bookmarks\Received;

function delete ($mysqli, $receivedBookmark) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedBookmark);

    include_once __DIR__.'/../../DeletedItems/addReceivedBookmark.php';
    \Users\DeletedItems\addReceivedBookmark($mysqli, $receivedBookmark);

}
