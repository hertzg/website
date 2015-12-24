<?php

namespace Users\Tasks\Sending;

function add ($mysqli, $user, $recipient,
    $text, $deadline_time, $tags, $top_priority) {

    include_once __DIR__.'/../../../SendingTasks/add.php';
    \SendingTasks\add($mysqli, $user->id_users,
        $user->username, $recipient['username'],
        $recipient['address'], $recipient['id_admin_connections'],
        $recipient['their_exchange_api_key'], $text,
        $deadline_time, $tags, $top_priority);

}
