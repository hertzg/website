<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once 'fns/require_contact.php';
$contact = require_contact($mysqli, $user->id_users);

include_once '../../fns/Users/Contacts/delete.php';
Users\Contacts\delete($mysqli, $contact, $user);

header('Content-Type: application/json');
echo 'true';
