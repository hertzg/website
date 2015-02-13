<?php

function require_event ($mysqli) {

    include_once __DIR__.'/../../fns/request_event.php';
    request_event($mysqli, $user, $id, $event);

    if (!$event) {
        unset($_SESSION['calendar/all-events/messages']);
        $error = 'The event no longer exists.';
        $_SESSION['calendar/all-events/errors'] = [$error];
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$event, $id, $user];

}
