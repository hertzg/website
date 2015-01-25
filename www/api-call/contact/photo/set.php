<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');

include_once '../fns/require_contact.php';
$contact = require_contact($mysqli, $user->id_users);

$fnsDir = '../../../fns';

include_once "$fnsDir/request_files.php";
list($file) = request_files('file');

$error = $file['error'];
if ($error === UPLOAD_ERR_OK) {
    $content = file_get_contents($file['tmp_name']);
    $image = @imagecreatefromstring($content);
    if ($image === false) {
        include_once '../../fns/bad_request.php';
        bad_request('INVALID_PHOTO');
    }
} elseif ($error === UPLOAD_ERR_NO_FILE) {
    include_once '../../fns/bad_request.php';
    bad_request('SELECT_FILE');
} else {
    include_once '../../fns/bad_request.php';
    bad_request('FILE_ERROR');
}

include_once "$fnsDir/Users/Contacts/Photo/set.php";
Users\Contacts\Photo\set($mysqli, $contact, $image);

header('Content-Type: application/json');
echo 'true';
