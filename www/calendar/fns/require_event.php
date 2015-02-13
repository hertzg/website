<?php

function require_event ($mysqli) {

    include_once __DIR__.'/request_event.php';
    request_event($mysqli, $user, $id, $event);

    if (!$event) {
        unset($_SESSION['calendar/messages']);
        $_SESSION['calendar/errors'] = ['The event no longer exists.'];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$event, $id, $user];

}
