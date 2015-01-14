<?php

namespace Users\DeletedItems;

function addBookmark ($mysqli, $bookmark) {
    include_once __DIR__.'/add.php';
    add($mysqli, $bookmark->id_users, 'bookmark', [
        'id' => $bookmark->id,
        'url' => $bookmark->url,
        'title' => $bookmark->title,
        'tags' => $bookmark->tags,
        'insert_api_key_id' => $bookmark->insert_api_key_id,
        'insert_time' => $bookmark->insert_time,
        'update_api_key_id' => $bookmark->update_api_key_id,
        'update_time' => $bookmark->update_time,
        'revision' => $bookmark->revision,
    ]);
}
