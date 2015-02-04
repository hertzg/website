<?php

function require_received_contact ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedContacts/getOnReceiver.php";
    $receivedContact = ReceivedContacts\getOnReceiver($mysqli, $id_users, $id);

    if (!$receivedContact) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_CONTACT_NOT_FOUND');
    }

    return $receivedContact;

}
