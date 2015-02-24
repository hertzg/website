<?php

namespace Users\Channels;

function index ($mysqli, $user) {

    if (!$user->num_channels) return [];

    include_once __DIR__.'/../../Channels/indexOnUser.php';
    return \Channels\indexOnUser($mysqli, $user->id_users);

}
