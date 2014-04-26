<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_contact.php';
list($id, $contact) = require_contact($mysqli, $id_users);

include_once '../../fns/Contacts/delete.php';
Contacts\delete($mysqli, $id);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/Users/addNumContacts.php';
Users\addNumContacts($mysqli, $id_users, -1);

header('Content-Type: application/json');
echo 'true';
