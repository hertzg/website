<?php

namespace Users\DeletedItems;

function addBookmark ($mysqli, $bookmark) {
    include_once __DIR__.'/add.php';
    add($mysqli, $bookmark->id_users, 'bookmark', [
        'id' => $bookmark->id_bookmarks,
        'url' => $bookmark->url,
        'title' => $bookmark->title,
        'tags' => $bookmark->tags,
        'insert_time' => $bookmark->insert_time,
        'update_time' => $bookmark->update_time,
    ]);
}
