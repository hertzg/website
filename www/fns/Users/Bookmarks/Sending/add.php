<?php

namespace Users\Bookmarks\Sending;

function add ($mysqli, $user, $recipient, $url, $title, $tags) {
    include_once __DIR__.'/../../../SendingBookmarks/add.php';
    \SendingBookmarks\add($mysqli,
        $user->id_users, $user->username, $recipient['username'],
        $recipient['address'], $recipient['id_admin_connections'],
        $recipient['their_exchange_api_key'], $url, $title, $tags);
}
