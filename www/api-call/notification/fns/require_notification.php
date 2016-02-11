<?php

function require_notification ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Notifications/get.php";
    $notification = Users\Notifications\get($mysqli, $user, $id);

    if (!$notification) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"NOTIFICATION_NOT_FOUND"');
    }

    return $notification;

}
