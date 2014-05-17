<?php

namespace Users\Notes;

function send ($mysqli, $user, $receiver_id_users, $note) {
    include_once __DIR__.'/Received/add.php';
    \Users\Notes\Received\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $note->text, $note->tags);
}
