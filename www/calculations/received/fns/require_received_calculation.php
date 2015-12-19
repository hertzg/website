<?php

function require_received_calculation ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Calculations/Received/get.php";
    $receivedCalculation = Users\Calculations\Received\get($mysqli, $user, $id);

    if (!$receivedCalculation) {
        unset($_SESSION['calculations/received/messages']);
        $error = 'The received calculation no longer exists.';
        $_SESSION['calculations/received/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect($base === '' ? './' : $base);
    }

    return [$receivedCalculation, $id, $user];

}
