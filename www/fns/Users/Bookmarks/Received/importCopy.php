<?php

namespace Users\Bookmarks\Received;

function importCopy ($mysqli, $receivedBookmark) {

    $tags = $receivedBookmark->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Bookmarks\add($mysqli, $receivedBookmark->receiver_id_users,
        $receivedBookmark->url, $receivedBookmark->title, $tags, $tag_names);

}
