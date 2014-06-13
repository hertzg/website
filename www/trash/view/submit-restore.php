<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);
$id_users = $user->id_users;

$type = $deletedItem->data_type;
$data = json_decode($deletedItem->data_json);

if ($type == 'bookmark') {
    include_once '../../fns/Users/Bookmarks/addDeleted.php';
    Users\Bookmarks\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'contact') {
    include_once '../../fns/Users/Contacts/addDeleted.php';
    Users\Contacts\addDeleted($mysqli, $user, $data);
} elseif ($type == 'note') {
    include_once '../../fns/Users/Notes/addDeleted.php';
    Users\Notes\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedBookmark') {
    include_once '../../fns/Users/Bookmarks/Received/addDeleted.php';
    Users\Bookmarks\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedContact') {
    include_once '../../fns/Users/Contacts/Received/addDeleted.php';
    Users\Contacts\Received\addDeleted($mysqli, $user, $data);
} elseif ($type == 'receivedNote') {
    include_once '../../fns/Users/Notes/Received/addDeleted.php';
    Users\Notes\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'receivedTask') {
    include_once '../../fns/Users/Tasks/Received/addDeleted.php';
    Users\Tasks\Received\addDeleted($mysqli, $id_users, $data);
} elseif ($type == 'task') {
    include_once '../../fns/Users/Tasks/addDeleted.php';
    Users\Tasks\addDeleted($mysqli, $id_users, $data);
}

include_once '../../fns/DeletedItems/delete.php';
DeletedItems\delete($mysqli, $id);

$_SESSION['trash/messages'] = ['The item has been restored.'];

include_once '../../fns/redirect.php';
redirect('..');
