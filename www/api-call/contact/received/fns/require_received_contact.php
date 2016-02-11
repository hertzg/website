<?php

function require_received_contact ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Contacts/Received/get.php";
    $receivedContact = Users\Contacts\Received\get($mysqli, $user, $id);

    if (!$receivedContact) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"RECEIVED_CONTACT_NOT_FOUND"');
    }

    return $receivedContact;

}
