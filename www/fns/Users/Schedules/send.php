<?php

namespace Users\Schedules;

function send ($mysqli, $user, $receiver_id_users, $schedule) {
    include_once __DIR__.'/Received/add.php';
    Received\add($mysqli, $user->id_users,
        $user->username, $receiver_id_users, $schedule->text,
        $schedule->interval, $schedule->offset, $schedule->tags);
}
