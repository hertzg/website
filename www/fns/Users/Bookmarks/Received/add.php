<?php

namespace Users\Bookmarks\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $url, $title, $tags) {

    include_once __DIR__.'/../../../ReceivedBookmarks/add.php';
    \ReceivedBookmarks\add($mysqli, $sender_id_users,
        $sender_username, $receiver_id_users, $url, $title, $tags);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

}
