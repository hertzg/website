<?php

namespace Users\Schedules\Sending;

function add ($mysqli, $user, $recipient, $text, $interval, $offset, $tags) {
    include_once __DIR__.'/../../../SendingSchedules/add.php';
    \SendingSchedules\add($mysqli, $user->id_users,
        $user->username, $recipient['username'],
        $recipient['address'], $recipient['id_admin_connections'],
        $recipient['their_exchange_api_key'],
        $text, $interval, $offset, $tags);
}
