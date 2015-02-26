<?php

namespace Users\Contacts\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_contacts) return;

    include_once __DIR__.'/../../../ReceivedContacts/getOnReceiver.php';
    return \ReceivedContacts\getOnReceiver($mysqli, $user->id_users, $id);

}
