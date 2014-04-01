<?php

function require_received_contact ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/ReceivedContacts/getOnReceiver.php';
    $receivedContact = ReceivedContacts\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedContact) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$receivedContact, $id, $user];

}
