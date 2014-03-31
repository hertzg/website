<?php

function require_event ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id_events) = request_strings('id_events');

    $id_events = abs((int)$id_events);

    include_once __DIR__.'/../../fns/Events/get.php';
    $event = Events\get($mysqli, $user->id_users, $id_events);

    if (!$event) {
        unset($_SESSION['calendar/messages']);
        $_SESSION['calendar/errors'] = [
            'The event no longer exists.',
        ];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$event, $id_events, $user];

}
