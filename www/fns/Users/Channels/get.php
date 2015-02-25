<?php

namespace Users\Channels;

function get ($mysqli, $user, $id) {

    if (!$user->num_channels) return;

    include_once __DIR__.'/../../Channels/getOnUser.php';
    return \Channels\getOnUser($mysqli, $user->id_users, $id);

}
