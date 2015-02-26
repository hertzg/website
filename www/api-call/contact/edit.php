<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once 'fns/require_contact.php';
$contact = require_contact($mysqli, $user);

include_once 'fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1, $phone2,
    $birthday_time, $username, $timezone, $tags, $tag_names,
    $notes, $favorite) = request_contact_params($user);

include_once '../../fns/Users/Contacts/edit.php';
Users\Contacts\edit($mysqli, $user, $contact, $full_name,
    $alias, $address, $email, $phone1, $phone2, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes, $favorite, $apiKey);

header('Content-Type: application/json');
echo 'true';
