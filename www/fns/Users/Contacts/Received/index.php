<?php

namespace Users\Contacts\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_contacts) return [];

    include_once __DIR__.'/../../../ReceivedContacts/indexOnReceiver.php';
    return \ReceivedContacts\indexOnReceiver($mysqli, $user->id_users);

}
