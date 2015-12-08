<?php

namespace Users\Calculations;

function send ($mysqli, $user, $receiver_id_users, $calculation) {
    include_once __DIR__.'/Received/add.php';
    Received\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $calculation->expression,
        $calculation->title, $calculation->tags, $calculation->value);
}
