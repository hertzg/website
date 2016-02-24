<?php

include_once '../fns/require_api_key.php';
require_api_key('contact/deleteAll',
    'can_write_contacts', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Contacts/deleteAll.php';
Users\Contacts\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
