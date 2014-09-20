<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli, '../');

$photo_id = $receivedContact->photo_id;
if (!$photo_id) {
    include_once '../../../fns/ErrorPage/notFound.php';
    ErrorPage\notFound();
}

include_once '../../../fns/ContactPhotos/path.php';
$path = ContactPhotos\path($photo_id);

header_remove('Expires');
header_remove('Pragma');
header('Cache-Control: private, max-age='.(60 * 60 * 24 * 30 * 12));
header('Content-Type: image/png');
header('Content-Length: '.filesize($path));

readfile($path);
