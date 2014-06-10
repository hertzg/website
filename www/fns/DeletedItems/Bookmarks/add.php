<?php

namespace DeletedItems\Bookmarks;

function add ($mysqli, $bookmark) {
    include_once __DIR__.'/../add.php';
    \DeletedItems\add($mysqli, $bookmark->id_users, 'bookmark', [
        'url' => $bookmark->url,
        'title' => $bookmark->title,
        'tags' => $bookmark->tags,
        'insert_time' => $bookmark->insert_time,
        'update_time' => $bookmark->update_time,
    ]);
}
