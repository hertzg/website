<?php

namespace Users\Contacts\Received;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_received_contacts) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedContacts/indexOnReceiver.php";
    $receivedContacts = \ReceivedContacts\indexOnReceiver($mysqli, $id_users);

    if ($receivedContacts) {
        include_once __DIR__.'/../../DeletedItems/addReceivedContact.php';
        foreach ($receivedContacts as $receivedContact) {
            \Users\DeletedItems\addReceivedContact(
                $mysqli, $receivedContact, $apiKey);
        }
    }

    include_once "$fnsDir/ReceivedContacts/deleteOnReceiver.php";
    \ReceivedContacts\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_contacts = 0,'
        .' num_archived_received_contacts = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
