<?php

include_once '../../fns/require_api_key.php';
require_api_key('can_read_contacts', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Contacts/Received/index.php';
$receivedContacts = Users\Contacts\Received\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $receivedContacts));
