<?php

namespace Users\Bookmarks\Received;

function import ($mysqli, $receivedBookmark) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedBookmark);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedBookmark);

    return $id;

}
