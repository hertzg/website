<?php

function require_event ($mysqli, $id_users) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Events/getOnUser.php';
    $event = Events\getOnUser($mysqli, $id_users, $id);

    if (!$event) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('EVENT_NOT_FOUND');
    }

    return $event;

}
