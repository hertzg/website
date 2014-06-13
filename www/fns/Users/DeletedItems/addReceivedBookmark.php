<?php

namespace Users\DeletedItems;

function addReceivedBookmark ($mysqli, $receivedBookmark) {
    $id_users = $receivedBookmark->receiver_id_users;
    include_once __DIR__.'/../../DeletedItems/add.php';
    \DeletedItems\add($mysqli, $id_users, 'receivedBookmark', [
        'id' => $receivedBookmark->id,
        'url' => $receivedBookmark->url,
        'title' => $receivedBookmark->title,
        'tags' => $receivedBookmark->tags,
        'insert_time' => $receivedBookmark->insert_time,
        'sender_id_users' => $receivedBookmark->sender_id_users,
        'sender_username' => $receivedBookmark->sender_username,
        'archived' => $receivedBookmark->archived,
    ]);
}
