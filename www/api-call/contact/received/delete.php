<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('contact/received/delete',
    'can_write_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_received_contact.php';
$receivedContact = require_received_contact($mysqli, $user);

include_once '../../../fns/Users/Contacts/Received/delete.php';
Users\Contacts\Received\delete($mysqli, $receivedContact, $apiKey);

header('Content-Type: application/json');
echo 'true';
