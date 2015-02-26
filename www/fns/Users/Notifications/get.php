<?php

namespace Users\Notifications;

function get ($mysqli, $user, $id) {

    if (!$user->num_notifications) return;

    include_once __DIR__.'/../../Notifications/getOnUser.php';
    return \Notifications\getOnUser($mysqli, $user->id_users, $id);

}
