<?php

namespace Users\Channels;

function add ($mysqli, $user, $channel_name,
    $public, $receive_notifications, $insertApiKey = null) {

    $id_users = $user->id_users;

    include_once __DIR__.'/../../Channels/add.php';
    $id = \Channels\add($mysqli, $id_users, $user->username,
        $channel_name, $public, $receive_notifications, $insertApiKey);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
