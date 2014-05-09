<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users);

include_once 'fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1,
    $phone2, $birthday_time, $username, $tags, $tag_names,
    $favorite) = request_contact_params($mysqli, $user->id_users);

include_once '../../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $full_name, $alias, $address, $email, $phone1,
    $phone2, $birthday_time, $username, $tags, $favorite);

header('Content-Type: application/json');
echo 'true';
