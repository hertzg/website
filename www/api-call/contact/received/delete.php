<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once 'fns/require_received_contact.php';
$receivedContact = require_received_contact($mysqli, $user->id_users);

include_once '../../../fns/Users/Contacts/Received/delete.php';
Users\Contacts\Received\delete($mysqli, $receivedContact, $apiKey);

header('Content-Type: application/json');
echo 'true';
