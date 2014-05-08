<?php

namespace Users\Contacts\Received;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../../ReceivedContacts/deleteOnReceiver.php';
    \ReceivedContacts\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_contacts = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
