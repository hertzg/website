<?php

namespace Users\Events;

function delete ($mysqli, $user, $event, $apiKey = null) {

    $id = $event->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Events/delete.php";
    \Events\delete($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $user->id_users, -1);

    include_once __DIR__.'/../DeletedItems/addEvent.php';
    \Users\DeletedItems\addEvent($mysqli, $event, $apiKey);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $event->event_time);

}
