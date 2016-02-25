<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('contact/get', 'can_read_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_contact.php';
$contact = require_contact($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($contact));
