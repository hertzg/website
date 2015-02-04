<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once '../fns/require_contact.php';
$contact = require_contact($mysqli, $user->id_users);

include_once '../../fns/require_file_param.php';
$file = require_file_param();

$content = file_get_contents($file['tmp_name']);
$image = @imagecreatefromstring($content);
if ($image === false) {
    include_once '../../fns/bad_request.php';
    bad_request('INVALID_PHOTO');
}

include_once '../../../fns/Users/Contacts/Photo/set.php';
Users\Contacts\Photo\set($mysqli, $contact, $image);

header('Content-Type: application/json');
echo 'true';
