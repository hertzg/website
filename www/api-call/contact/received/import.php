<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_received_contact.php';
$receivedContact = require_received_contact($mysqli, $user->id_users);

include_once '../../../fns/Users/Contacts/Received/import.php';
$id = Users\Contacts\Received\import($mysqli, $user, $receivedContact);

header('Content-Type: application/json');
echo $id;
