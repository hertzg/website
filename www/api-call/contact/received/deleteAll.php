<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('contact/received/deleteAll',
    'can_write_contacts', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Contacts/Received/deleteAll.php';
Users\Contacts\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
