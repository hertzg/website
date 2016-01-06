<?php

namespace Users\Contacts\Received;

function purge ($mysqli, $receivedContact) {

    include_once __DIR__.'/../../../ReceivedContacts/delete.php';
    \ReceivedContacts\delete($mysqli, $receivedContact->id);

    $id_users = $receivedContact->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedContact->archived ? -1 : 0);

}
