<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);
$id_users = $user->id_users;

$data_type = $deletedItem->data_type;
$data_json = json_decode($deletedItem->data_json);

if ($data_type == 'bookmark') {
    include_once '../../fns/Users/Bookmarks/addDeleted.php';
    Users\Bookmarks\addDeleted($mysqli, $id_users, $data_json);
} elseif ($data_type == 'contact') {
    include_once '../../fns/Users/Contacts/addDeleted.php';
    Users\Contacts\addDeleted($mysqli, $user, $data_json);
} elseif ($data_type == 'note') {
    include_once '../../fns/Users/Notes/addDeleted.php';
    Users\Notes\addDeleted($mysqli, $id_users, $data_json);
} elseif ($data_type == 'task') {
    include_once '../../fns/Users/Tasks/addDeleted.php';
    Users\Tasks\addDeleted($mysqli, $id_users, $data_json);
}

include_once '../../fns/DeletedItems/delete.php';
DeletedItems\delete($mysqli, $id);

$_SESSION['trash/messages'] = ['The item has been restored.'];

include_once '../../fns/redirect.php';
redirect('..');
