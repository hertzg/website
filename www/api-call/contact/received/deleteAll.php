<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once '../../../fns/Users/Contacts/Received/deleteAll.php';
Users\Contacts\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
