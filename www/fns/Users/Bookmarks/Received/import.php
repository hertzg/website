<?php

namespace Users\Bookmarks\Received;

function import ($mysqli, $receivedBookmark, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedBookmark, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedBookmark);

    return $id;

}
