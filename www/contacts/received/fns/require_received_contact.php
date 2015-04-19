<?php

function require_received_contact ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Contacts/Received/get.php";
    $receivedContact = Users\Contacts\Received\get($mysqli, $user, $id);

    if (!$receivedContact) {
        unset($_SESSION['contacts/received/messages']);
        $error = 'The received contact no longer exists.';
        $_SESSION['contacts/received/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect("$base./");
    }

    return [$receivedContact, $id, $user];

}
