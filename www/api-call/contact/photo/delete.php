<?php

include_once '../../fns/require_api_key.php';
require_api_key('contact/photo/delete',
    'can_write_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_contact_with_photo.php';
$contact = require_contact_with_photo($mysqli, $user);

include_once '../../../fns/Users/Contacts/Photo/delete.php';
Users\Contacts\Photo\delete($mysqli, $contact);

header('Content-Type: application/json');
echo 'true';
