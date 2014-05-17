<?php

namespace Users\Tasks;

function send ($mysqli, $user, $receiver_id_users, $task) {
    include_once __DIR__.'/Received/add.php';
    \Users\Tasks\Received\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $task->text, $task->top_priority, $task->tags);
}
