<?php

include_once '../../fns/require_api_key.php';
require_api_key('contact/received/get',
    'can_read_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_received_contact.php';
$receivedContact = require_received_contact($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($receivedContact));
