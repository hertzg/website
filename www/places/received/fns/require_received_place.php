<?php

function require_received_place ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Places/Received/get.php";
    $receivedPlace = Users\Places\Received\get($mysqli, $user, $id);

    if (!$receivedPlace) {
        unset($_SESSION['places/received/messages']);
        $error = 'The received place no longer exists.';
        $_SESSION['places/received/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect($base === '' ? './' : $base);
    }

    return [$receivedPlace, $id, $user];

}
