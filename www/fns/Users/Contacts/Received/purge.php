<?php

namespace Users\Contacts\Received;

function purge ($mysqli, $receivedContact) {

    include_once __DIR__.'/../../../ReceivedContacts/delete.php';
    \ReceivedContacts\delete($mysqli, $receivedContact->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receivedContact->receiver_id_users, -1);

}
