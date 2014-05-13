<?php

function to_client_json ($bookmark) {
    return [
        'id' => (int)$bookmark->id_bookmarks,
        'url' => $bookmark->url,
        'title' => $bookmark->title,
        'tags' => $bookmark->tags,
        'insert_time' => (int)$bookmark->insert_time,
        'update_time' => (int)$bookmark->update_time,
    ];
}
