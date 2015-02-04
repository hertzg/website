<?php

function require_notification ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Notifications/getOnUser.php";
    $notification = Notifications\getOnUser($mysqli, $id_users, $id);

    if (!$notification) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('NOTIFICATION_NOT_FOUND');
    }

    return $notification;

}
