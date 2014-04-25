<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/request_contact_params.php';
list($full_name, $tags, $tag_names) = request_contact_params();

include_once '../../fns/Contacts/add.php';
$id = Contacts\add($mysqli, $id_users, $full_name, $tags);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id, $tag_names, $full_name);

header('Content-Type: application/json');
echo json_encode(['id' => $id]);
