<?php

namespace Users\Bookmarks;

function send ($mysqli, $user, $receiver_id_users, $bookmark) {
    include_once __DIR__.'/Received/add.php';
    \Users\Bookmarks\Received\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $bookmark->url, $bookmark->title, $bookmark->tags);
}
