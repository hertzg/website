<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_deleted_item.php';
include_once '../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);
$id_users = $user->id_users;

$type = $deletedItem->data_type;
$data = json_decode($deletedItem->data_json);

if ($type == 'barChart') {
    include_once '../fns/Users/BarCharts/addDeleted.php';
    Users\BarCharts\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'bookmark') {
    include_once '../fns/Users/Bookmarks/addDeleted.php';
    Users\Bookmarks\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'calculation') {
    include_once '../fns/Users/Calculations/addDeleted.php';
    Users\Calculations\addDeleted($mysqli, $user, $data);
} elseif ($type == 'contact') {
    include_once '../fns/Users/Contacts/addDeleted.php';
    Users\Contacts\addDeleted($mysqli, $user, $data);
} elseif ($type == 'file') {
    include_once '../fns/Users/Files/addDeleted.php';
    Users\Files\addDeleted($mysqli, $user, $data);
} elseif ($type == 'folder') {

    include_once '../fns/Users/Folders/addDeleted.php';
    Users\Folders\addDeleted($mysqli, $user, $data);

    include_once '../fns/DeletedFolders/deleteOnDeletedItem.php';
    DeletedFolders\deleteOnDeletedItem($mysqli, $id);

    include_once '../fns/DeletedFiles/deleteOnDeletedItem.php';
    DeletedFiles\deleteOnDeletedItem($mysqli, $id);

} elseif ($type == 'note') {
    include_once '../fns/Users/Notes/addDeleted.php';
    Users\Notes\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'event') {
    include_once '../fns/Users/Events/addDeleted.php';
    Users\Events\addDeleted($mysqli, $user, $data);
} elseif ($type == 'place') {
    include_once '../fns/Users/Places/addDeleted.php';
    Users\Places\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedBookmark') {
    include_once '../fns/Users/Bookmarks/Received/addDeleted.php';
    Users\Bookmarks\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedCalculation') {
    include_once '../fns/Users/Calculations/Received/addDeleted.php';
    Users\Calculations\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedContact') {
    include_once '../fns/Users/Contacts/Received/addDeleted.php';
    Users\Contacts\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedFile') {
    include_once '../fns/Users/Files/Received/addDeleted.php';
    Users\Files\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedFolder') {
    include_once '../fns/Users/Folders/Received/addDeleted.php';
    Users\Folders\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedNote') {
    include_once '../fns/Users/Notes/Received/addDeleted.php';
    Users\Notes\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedPlace') {
    include_once '../fns/Users/Places/Received/addDeleted.php';
    Users\Places\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedSchedule') {
    include_once '../fns/Users/Schedules/Received/addDeleted.php';
    Users\Schedules\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedTask') {
    include_once '../fns/Users/Tasks/Received/addDeleted.php';
    Users\Tasks\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'schedule') {
    include_once '../fns/Users/Schedules/addDeleted.php';
    Users\Schedules\addDeleted($mysqli, $user, $data);
} elseif ($type == 'task') {
    include_once '../fns/Users/Tasks/addDeleted.php';
    Users\Tasks\addDeleted($mysqli, $user, $data);
} elseif ($type == 'wallet') {
    include_once '../fns/Users/Wallets/addDeleted.php';
    Users\Wallets\addDeleted($mysqli, $id_users, $data);
}

include_once '../fns/Users/DeletedItems/delete.php';
Users\DeletedItems\delete($mysqli, $deletedItem);

unset($_SESSION['trash/errors']);
$_SESSION['trash/messages'] = ['The item has been restored.'];

include_once '../fns/redirect.php';
redirect();
