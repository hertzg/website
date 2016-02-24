<?php

include_once '../../fns/require_api_key.php';
require_api_key('contact/received/importCopy',
    'can_write_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_received_contact.php';
$receivedContact = require_received_contact($mysqli, $user);

include_once '../../../fns/Users/Contacts/Received/importCopy.php';
$id = Users\Contacts\Received\importCopy(
    $mysqli, $user, $receivedContact, $apiKey);

header('Content-Type: application/json');
echo $id;
