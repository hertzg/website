<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once 'fns/request_contact_params.php';
list($full_name, $alias, $address, $email1, $email2, $phone1,
    $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes,
    $favorite) = request_contact_params($user);

include_once '../../fns/Users/Contacts/add.php';
$id = Users\Contacts\add($mysqli, $user, $full_name,
    $alias, $address, $email1, $email2, $phone1, $phone1_label,
    $phone2, $phone2_label, $birthday_time, $username, $timezone,
    $tags, $tag_names, $notes, $favorite, null, $apiKey);

header('Content-Type: application/json');
echo $id;
