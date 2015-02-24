<?php

namespace Users\Notifications;

function index ($mysqli, $user) {

    if (!$user->num_notifications) return [];

    include_once __DIR__.'/../../Notifications/indexOnUser.php';
    return \Notifications\indexOnUser($mysqli, $user->id_users);

}
