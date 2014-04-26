<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1,
    $phone2, $birthday_time, $username, $tags, $tag_names,
    $favorite) = request_contact_params($mysqli, $id_users);

include_once '../../fns/Contacts/add.php';
$id = Contacts\add($mysqli, $id_users, $full_name, $alias, $address, $email,
    $phone1, $phone2, $birthday_time, $username, $tags, $favorite);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id,
    $tag_names, $full_name, $alias, $favorite);

include_once '../../fns/invalidate_user_birthdays.php';
invalidate_user_birthdays($mysqli, $user, $birthday_time);

header('Content-Type: application/json');
echo json_encode(['id' => $id]);
