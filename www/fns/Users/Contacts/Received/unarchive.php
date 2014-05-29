<?php

namespace Users\Contacts\Received;

function unarchive ($mysqli, $receivedContact) {
    include_once __DIR__.'/../../../ReceivedContacts/setArchived.php';
    \ReceivedContacts\setArchived($mysqli, $receivedContact->id, false);
}
