<?php

namespace Users\Contacts\Received;

function archive ($mysqli, $receivedContact) {

    if ($receivedContact->archived) return;

    include_once __DIR__.'/../../../ReceivedContacts/setArchived.php';
    \ReceivedContacts\setArchived($mysqli, $receivedContact->id, true);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedContact->receiver_id_users, 1);

}
