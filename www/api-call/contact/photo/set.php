<?php

include_once '../../fns/require_api_key.php';
require_api_key('can_write_contacts', $apiKey, $user, $mysqli);

include_once '../fns/require_contact.php';
$contact = require_contact($mysqli, $user);

include_once '../../fns/require_file_param.php';
$file = require_file_param();

$content = file_get_contents($file['tmp_name']);
$image = @imagecreatefromstring($content);
if ($image === false) {
    include_once '../../../fns/ApiCall/Error/badRequest.php';
    ApiCall\Error\badRequest('"INVALID_PHOTO"');
}

include_once '../../../fns/Users/Contacts/Photo/set.php';
Users\Contacts\Photo\set($mysqli, $contact, $image);

header('Content-Type: application/json');
echo 'true';
