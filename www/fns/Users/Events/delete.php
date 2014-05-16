<?php

namespace Users\Events;

function delete ($mysqli, $user, $event) {

    include_once __DIR__.'/../../Events/delete.php';
    \Events\delete($mysqli, $event->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $user->id_users, -1);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $event->event_time);

}
