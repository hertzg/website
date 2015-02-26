<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once 'fns/require_received_contact.php';
$receivedContact = require_received_contact($mysqli, $user);

include_once '../../../fns/Users/Contacts/Received/importCopy.php';
$id = Users\Contacts\Received\importCopy(
    $mysqli, $user, $receivedContact, $apiKey);

header('Content-Type: application/json');
echo $id;
