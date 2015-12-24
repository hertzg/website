<?php

namespace Users\Calculations\Sending;

function add ($mysqli, $user, $recipient, $expression, $title, $tags) {
    include_once __DIR__.'/../../../SendingCalculations/add.php';
    \SendingCalculations\add($mysqli,
        $user->id_users, $user->username, $recipient['username'],
        $recipient['address'], $recipient['id_admin_connections'],
        $recipient['their_exchange_api_key'], $expression, $title, $tags);
}
