<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

$type = $deletedItem->data_type;
if ($type != 'contact' && $type != 'receivedContact') {
    include_once '../../fns/ErrorPage/notFound.php';
    ErrorPage\notFound();
}

$data = json_decode($deletedItem->data_json);
$photo_id = $data->photo_id;

if (!$photo_id) {
    include_once '../../fns/ErrorPage/notFound.php';
    ErrorPage\notFound();
}

include_once '../../fns/ContactPhotos/path.php';
$path = ContactPhotos\path($photo_id);

header_remove('Expires');
header_remove('Pragma');
header('Cache-Control: private, max-age='.(60 * 60 * 24 * 30 * 12));
header('Content-Type: image/png');
header('Content-Length: '.filesize($path));

readfile($path);
