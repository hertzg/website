<?php

namespace Users\Notes\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $tags, $encrypt) {

    include_once __DIR__.'/../../../ReceivedNotes/add.php';
    \ReceivedNotes\add($mysqli, $sender_id_users, $sender_username,
        $receiver_id_users, $text, $tags, $encrypt);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

}
