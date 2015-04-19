<?php

function require_received_note ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Notes/Received/get.php";
    $receivedNote = Users\Notes\Received\get($mysqli, $user, $id);

    if (!$receivedNote) {
        unset($_SESSION['notes/received/messages']);
        $error = 'The received note no longer exists.';
        $_SESSION['notes/received/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect($base === '' ? './' : $base);
    }

    return [$receivedNote, $id, $user];

}
