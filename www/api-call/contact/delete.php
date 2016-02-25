<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('contact/delete',
    'can_write_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_contact.php';
$contact = require_contact($mysqli, $user);

include_once '../../fns/Users/Contacts/delete.php';
Users\Contacts\delete($mysqli, $contact, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
