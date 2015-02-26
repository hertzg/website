<?php

function require_event ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Events/get.php";
    $event = Users\Events\get($mysqli, $user, $id);

    if (!$event) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('EVENT_NOT_FOUND');
    }

    return $event;

}
