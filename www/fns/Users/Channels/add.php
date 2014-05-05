<?php

namespace Users\Channels;

function add ($mysqli, $user, $channel_name, $public) {

    $id_users = $user->id_users;

    include_once __DIR__.'/../../Channels/add.php';
    $id = \Channels\add($mysqli, $id_users, $user->username, $channel_name, $public);

    include_once __DIR__.'/../../Users/Channels/addNumber.php';
    \Users\Channels\addNumber($mysqli, $id_users, 1);

    return $id;

}
