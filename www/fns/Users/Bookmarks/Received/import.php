<?php

namespace Users\Bookmarks\Received;

function import ($mysqli, $receivedBookmark) {

    $tags = $receivedBookmark->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    $id = \Users\Bookmarks\add($mysqli, $receivedBookmark->receiver_id_users,
        $receivedBookmark->url, $receivedBookmark->title, $tags, $tag_names);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedBookmark);

    return $id;

}
