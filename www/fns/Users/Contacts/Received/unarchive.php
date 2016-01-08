<?php

namespace Users\Contacts\Received;

function unarchive ($mysqli, $receivedContact) {

    if (!$receivedContact->archived) return;

    include_once __DIR__.'/../../../ReceivedContacts/setArchived.php';
    \ReceivedContacts\setArchived($mysqli, $receivedContact->id, false);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receivedContact->receiver_id_users, 0, -1);

}
