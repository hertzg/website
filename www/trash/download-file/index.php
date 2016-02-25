<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli, '../');
$id_users = $user->id_users;

$fnsDir = '../../fns';

$data = json_decode($deletedItem->data_json);

$type = $deletedItem->data_type;
if ($type == 'file') {
    include_once "$fnsDir/Files/File/path.php";
    $path = Files\File\path($id_users, $data->id);
} elseif ($type == 'receivedFile') {
    include_once "$fnsDir/ReceivedFiles/File/path.php";
    $path = ReceivedFiles\File\path($id_users, $data->id);
} else {
    include_once "$fnsDir/ErrorPage/notFound.php";
    ErrorPage\notFound();
}

include_once "$fnsDir/echo_file.php";
echo_file($data, $path);
