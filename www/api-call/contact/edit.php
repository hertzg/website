<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/require_contact.php';
list($id, $contact) = require_contact($mysqli, $id_users);

include_once 'fns/request_contact_params.php';
list($text, $tags, $tag_names) = request_contact_params();

include_once '../../fns/Contacts/edit.php';
Contacts\edit($mysqli, $id_users, $id, $text, $tags);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id, $tag_names, $text);

header('Content-Type: application/json');
echo 'true';
