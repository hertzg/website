<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_contact.php';
list($id, $contact) = require_contact($mysqli, $id_users);

include_once 'fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1,
    $phone2, $birthday_time, $username, $tags, $tag_names,
    $favorite) = request_contact_params($mysqli, $id_users, $id);

include_once '../../fns/Contacts/edit.php';
Contacts\edit($mysqli, $id_users, $id, $full_name, $alias, $address, $email,
    $phone1, $phone2, $birthday_time, $username, $tags, $favorite);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id,
    $tag_names, $full_name, $alias, $favorite);

header('Content-Type: application/json');
echo 'true';
