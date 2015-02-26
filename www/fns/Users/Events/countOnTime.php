<?php

namespace Users\Events;

function countOnTime ($mysqli, $user, $event_time) {

    if (!$user->num_events) return 0;

    include_once __DIR__.'/../../Events/countOnTime.php';
    return \Events\countOnTime($mysqli, $user->id_users, $event_time);

}
