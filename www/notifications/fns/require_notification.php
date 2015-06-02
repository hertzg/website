<?php

function require_notification ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Notifications/get.php";
    $notification = Users\Notifications\get($mysqli, $user, $id);

    if (!$notification) {
        unset($_SESSION['notifications/messages']);
        $error = 'The notification no longer exists.';
        $_SESSION['notifications/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$notification, $id, $user];

}
