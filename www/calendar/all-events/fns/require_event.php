<?php

function require_event ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Events/getOnUser.php";
    $event = Events\getOnUser($mysqli, $user->id_users, $id);

    if (!$event) {
        unset($_SESSION['calendar/all-events/messages']);
        $_SESSION['calendar/all-events/errors'] = ['The event no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$event, $id, $user];

}
