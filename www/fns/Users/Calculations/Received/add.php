<?php

namespace Users\Calculations\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $url, $title, $tags, $sender_address = null) {

    include_once __DIR__.'/../../../ReceivedCalculations/add.php';
    \ReceivedCalculations\add($mysqli, $sender_address, $sender_id_users,
        $sender_username, $receiver_id_users, $url, $title, $tags);

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
