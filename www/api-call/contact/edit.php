<?php

include_once '../fns/require_api_key.php';
require_api_key('contact/edit', 'can_write_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_contact.php';
$contact = require_contact($mysqli, $user);

include_once 'fns/require_contact_params.php';
require_contact_params($user, $full_name, $alias,
    $address, $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes, $favorite);

include_once '../../fns/Users/Contacts/edit.php';
Users\Contacts\edit($mysqli, $user, $contact, $full_name,
    $alias, $address, $email1, $email1_label, $email2,
    $email2_label, $phone1, $phone1_label, $phone2,
    $phone2_label, $birthday_time, $username, $timezone,
    $tags, $tag_names, $notes, $favorite, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
