<?php

namespace Users\Notes\Sending;

function add ($mysqli, $user, $recipient, $text, $tags, $encrypt_in_listings) {
    include_once __DIR__.'/../../../SendingNotes/add.php';
    \SendingNotes\add($mysqli, $user->id_users, $user->username,
        $recipient['username'], $recipient['address'],
        $recipient['id_admin_connections'],
        $recipient['their_exchange_api_key'],
        $text, $tags, $encrypt_in_listings);
}
