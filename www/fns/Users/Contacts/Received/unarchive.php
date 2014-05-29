<?php

namespace Users\Contacts\Received;

function unarchive ($mysqli, $receivedContact) {
    if ($receivedContact->archived) {

        include_once __DIR__.'/../../../ReceivedContacts/setArchived.php';
        \ReceivedContacts\setArchived($mysqli, $receivedContact->id, false);

        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $receivedContact->receiver_id_users, -1);

    }
}
