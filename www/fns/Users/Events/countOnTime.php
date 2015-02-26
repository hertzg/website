<?php

namespace Users\Events;

function countOnTime ($mysqli, $user, $event_time) {

    if (!$user->num_events) return 0;

    include_once __DIR__.'/../../Events/countOnUserAndTime.php';
    return \Events\countOnUserAndTime($mysqli, $user->id_users, $event_time);

}
