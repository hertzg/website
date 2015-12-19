<?php

namespace Users\Calculations;

function send ($mysqli, $user, $receiver_id_users, $calculation) {
    include_once __DIR__.'/Received/add.php';
    Received\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $calculation->resolved_expression,
        $calculation->title, $calculation->tags, $calculation->value,
        $calculation->error, $calculation->error_char);
}
