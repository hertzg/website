<?php

function require_event ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($idevents) = request_strings('idevents');

    $idevents = abs((int)$idevents);

    include_once __DIR__.'/../../fns/Events/get.php';
    $event = Events\get($mysqli, $user->idusers, $idevents);

    if (!$event) {
        unset($_SESSION['calendar/messages']);
        $_SESSION['calendar/errors'] = [
            'The event no longer exists.',
        ];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$event, $idevents, $user];

}
